# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

Fodex is a Laravel 9 (PHP 7.3/8.0) monolith for a multi-vendor food delivery platform. It combines a
server-rendered admin/seller/company back office (Blade + yajra DataTables) with a stateless JSON API
consumed by customer, seller-employee, and driver mobile apps. Default locale is Arabic (`ar`), fallback `en`.

## Commands

```bash
# Install PHP deps
composer install

# Install & build frontend assets (Laravel Mix / webpack, Sass)
npm install
npm run dev          # development build
npm run watch        # rebuild on change
npm run prod          # production build

# Run the app locally
php artisan serve

# Database
php artisan migrate
php artisan db:seed

# Tests (PHPUnit, in-memory sqlite — see phpunit.xml)
php artisan test
vendor/bin/phpunit
vendor/bin/phpunit --filter TestName
vendor/bin/phpunit tests/Feature/SomeTest.php

# Caches (useful after route/config changes during debugging)
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

There is no CI/lint script configured in this repo beyond StyleCI (`.styleci.yml`, Laravel preset, runs on
the styleci.io service rather than locally). `tests/` currently only contains the default Laravel
`ExampleTest` skeletons — there is no real test suite to model new tests on yet.

## Architecture

### Four route files, one `RouteServiceProvider`

`app/Providers/RouteServiceProvider::map()` wires up four separate route files, each with its own
prefix/middleware/namespace convention:

- `routes/web.php` — the **admin** back office. `web` middleware, guard `auth:employee`. Controllers live
  directly in `App\Http\Controllers` (no subnamespace) and views in `resources/views/admindashboard/*`.
- `routes/api.php` — the **customer-facing JSON API**, mounted under `/api`, namespace `api`
  (`App\Http\Controllers\api`). Public routes are outside the `auth:api` group; authenticated ones inside it.
- `routes/seller.php` — JSON API for **seller employees** (in-store staff), mounted under `/api/seller`,
  namespace `api\selleremployees`, guard `auth:selleremployee_api`.
- `routes/dash_company.php` — the **delivery-company / driver** back office, mounted under
  `/companydashboard`, namespace `CompanyDashboard`, guard `auth:driver`. Views in
  `resources/views/companydashboard/*`.

There's also a driver-facing JSON API under `App\Http\Controllers\api\drivers` (guard `driver_api`), wired
from within `routes/api.php`/related groups rather than its own top-level file.

### Multiple auth guards, multiple user models

`config/auth.php` defines five independent Eloquent guards, each with its own model and its own
session/token pair — there is no single "user" concept:

| Guard | Model | Driver |
|---|---|---|
| `web` / `api` | `App\User` (note: **not** `App\Models\User`) | session / token |
| `employee` | `App\Models\Employee` | session |
| `seller` | `App\Models\Seller` | session |
| `selleremployee` / `selleremployee_api` | `App\Models\SellerEmployee` | session / token |
| `driver` / `driver_api` | `App\Models\Driver` | session / token |

All of these use `Laratrust\Traits\LaratrustUserTrait` for roles/permissions (santigarcor/laratrust) —
check `config/laratrust.php` and `app/Models/{Role,Permission}.php` before adding new authorization checks.

### API controller conventions

API controllers (`app/Http/Controllers/api/**`) follow a consistent shape — use existing controllers like
`app/Http/Controllers/api/CentralSellerController.php` as the template for new endpoints:

- `use App\traits\ApiTrait;` for uniform JSON responses: `errorResponse()`, `successResponse()`,
  `dataResponse()`, `getvalidationErrors($validator)`, `returnException($e->getMessage(), 500)`.
- Validate with `Illuminate\Support\Facades\Validator::make()` and return `getvalidationErrors()` on failure.
- Wrap the body in `try { ... } catch (\Exception $ex) { return $this->returnException(...); }`.
- Shape output with an `Http\Resources\*` API resource rather than returning models directly.
- Arabic user-facing messages (`$msg = 'رسالة بالعربي'`) are the norm in API responses.

`app/traits/generaltrait.php` holds shared non-response helpers (image upload, haversine distance, FCM
push notification sending).

### Global scopes for multi-tenant-style visibility

Eloquent global scopes are used to change default query visibility per context, e.g.
`app/Scopes/CentralRestaurantVisibilityScope.php` is registered in `Seller::booted()` and hides
`is_central` sellers from regular queries. When a query genuinely needs the excluded rows (e.g. the
central-sellers API endpoint), use `Seller::withoutGlobalScope(CentralRestaurantVisibilityScope::class)`
explicitly rather than removing the scope.

### Admin dashboard (DataTables)

Admin list views use `yajra/laravel-datatables`. Each resource typically has a matching class in
`app/DataTables/*DataTable.php` (query + column definitions) paired with a controller action and a Blade
view under `resources/views/admindashboard/<resource>/`. When adding a new admin CRUD resource, follow
this Controller + DataTable + Blade-view triplet rather than building ad-hoc queries in the controller.

### Translatable content

`astrotomic/laravel-translatable` is available for models needing multi-locale fields (used selectively,
not globally) — check whether a model already has translation tables before adding new locale-aware
fields directly to a base table.

### Frontend assets

Laravel Mix compiles `resources/js/app.js` → `public/js` and `resources/sass/app.scss` → `public/css`
(see `webpack.mix.js`). There is no SPA/Vue app wired up despite `vue-template-compiler` being present in
`package.json` — treat this as a traditional Blade + jQuery/DataTables admin UI, not a Vue app, unless you
find evidence otherwise in the specific view you're editing.