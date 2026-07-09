# Merge seller contract form into seller creation form

## Context

Today, creating a seller and creating its financial contract are two disconnected steps:
`resources/views/admindashboard/sellers/V2/create.blade.php` (posts to `seller.store`) only creates the
`Seller` + its `Address` + a default `SellerEmployee`. The contract (`Sellercontract`: from/to dates,
commission percentage, notes, signed paper image) is created afterward via a totally separate page
(`addsellercontract.blade.php` → `storesellercontract/{id}`), which an admin has to remember to visit.

The create form already has an empty, unused placeholder section titled "العقود المالية" (Financial
Contracts) right before the submit button, and `SellerController@store` has a fully-written-but-commented-out
block that creates a `Sellercontract` — a clear abandoned first attempt at exactly this feature. The goal is
to finish that attempt: fold the contract fields into the seller creation form so a seller and its initial
contract are created together in one submit, using the existing `storesellercontract` logic as the reference
implementation for field handling. Per user decision: contract fields will be **required**, and the section
applies identically to **both regular and central sellers** (no conditional logic needed).

## Files to change

### 1. `resources/views/admindashboard/sellers/V2/create.blade.php`

**Remove dead code**: the commented-out `from_day`/`to_day`/`percentage`/`notes` block currently sitting in
the "معلومات العنوان" (address) section, lines 288–314. It's a stray leftover from an earlier, abandoned
attempt to put contract fields in the wrong section — remove it now that the real fields are being added
in the correct place.

**Populate the "العقود المالية" section** (currently just a header, lines ~446–453, right before the submit
button) with fields modeled directly on `resources/views/admindashboard/sellers/addsellercontract.blade.php`,
reusing the same field names so the existing controller logic pattern applies unchanged:

- Paper contract image upload — reuse the exact `image-input-outline` block from `addsellercontract.blade.php`
  (`id="kt_image_3"`, wrapper `id="im4"`, file input `id="do4" name="paper_contract_image" required`).
  Note: `create.blade.php`'s own `@section('scripts')` (lines 578–596) **already defines** `readURL4()` and
  `$("#do4").change(...)` wired to `#im4`/`#do4` — this JS currently has no matching HTML in the page. Adding
  this block wires it up with no JS changes needed.
- `from_day` — `type="date"`, `name="from_day"`, `required`, `@error('from_day')` block.
- `to_day` — `type="date"`, `name="to_day"`, `required`, `@error('to_day')` block.
- `percentage` — `type="number"`, `name="percentage"`, `required`, `@error('percentage')` block.
- `notes` — `<textarea name="notes">`, `@error('notes')` block (kept optional, matching the standalone form,
  which doesn't mark it `required`).

Layout: follow the existing form's row/col-6 grouping convention used throughout the rest of the file.

### 2. `app/Http/Controllers/SellerController.php` — `store()` method

**Validation** (top of method, alongside the existing `$request->validate([...])` at lines 128–133): add
- `'from_day' => 'required|date'`
- `'to_day' => 'required|date|after_or_equal:from_day'`
- `'percentage' => 'required|numeric'`
- `'paper_contract_image' => 'required|image|max:10240'`

**Contract creation**: replace the commented-out block at lines 209–222 with live code, placed after
`$employee->save();` (line 208) so it runs after the seller is fully persisted and has an id — same
position the dead code already occupied:

```php
$contract = new Sellercontract;
$contract->from_day = $request->from_day;
$contract->to_day = $request->to_day;
$contract->percentage = $request->percentage;
$contract->notes = $request->notes;
if ($request->hasFile('paper_contract_image')) {
    $image = $this->uploadimage($request->paper_contract_image, 'contracts');
    $contract->paper_contract_image = $image;
}
$contract->seller_id = $seller->id;
$contract->active = 1;
$contract->save();
```

This mirrors `storesellercontract()` (lines 424–441) field-for-field, minus the
`Sellercontract::where('seller_id', $id)->update(['active' => 0])` deactivation step — that step exists in
`storesellercontract` to handle *renewing* an existing seller's contract, which doesn't apply to a
brand-new seller. `Sellercontract` is already imported in this file (line 20), so no new `use` statement
is needed.

No changes needed to `Seller.php` or `Sellercontract.php` models, or to the `sellercontracts` table schema —
all required columns (`from_day`, `to_day`, `percentage`, `notes`, `paper_contract_image`, `seller_id`,
`active`) already exist per the live DB schema.

### Out of scope (not touching)

- `V2/edit.blade.php` has the same kind of dead/commented contract-field scaffolding, but the user's request
  was specifically about the create form. Leaving edit alone.
- The standalone `sellercontracts` / `addsellercontract` / `editsellercontract` pages and routes stay as-is,
  for viewing/renewing a seller's contract after initial creation.
- Note (unrelated, flagged for awareness only): migration `2026_07_09_113830_add_column_to_sellers_table.php`
  (adds `delivery_phone`/`discount_type` to `sellers`) has not been run yet per `migrate:status` — needed for
  `store()` to work at all currently, independent of this change.

## Verification

1. Run `php artisan migrate` if the pending `delivery_phone`/`discount_type` migration hasn't been applied.
2. Start the app (`php artisan serve` + `npm run dev` if assets need rebuilding — no JS/CSS changes here, so
   likely unnecessary) and log in as an employee (`auth:employee` guard).
3. Visit the "add seller" page (`seller.create` route) — confirm the "العقود المالية" section now renders
   the image upload + from_day/to_day/percentage/notes fields, and that the paper-contract image preview
   (`#im4`) updates on file selection (confirms the existing `readURL4` JS is now wired correctly).
4. Submit the form without filling contract fields — confirm validation errors appear under the new fields
   and no `Seller` row is created (required-field enforcement).
5. Submit the form fully filled out — confirm:
   - A `Seller` row is created as before.
   - A `Sellercontract` row is created with matching `seller_id`, correct `from_day`/`to_day`/`percentage`/
     `notes`, `active = 1`, and `paper_contract_image` pointing to an uploaded file under
     `storage/app/uploads/contracts` (or wherever the `uploads` disk resolves).
   - The seller list page (`seller.index` or `seller.central_index` if `is_central` was set) shows the new
     seller.
6. Repeat step 5 with the central-seller creation route (`seller.add_central` → same view, `is_central=1`)
   to confirm identical contract-creation behavior for central sellers.
