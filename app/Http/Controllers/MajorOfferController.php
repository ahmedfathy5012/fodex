<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorOffer;
use App\traits\generaltrait;
use App\DataTables\MajorOfferDataTable;
use Illuminate\Support\Facades\File;
use App\Models\Seller;

class MajorOfferController extends Controller
{
    use generaltrait;

    private function majorOfferView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.majors.offers.$page"
            : "admindashboard.majors.offers.V2.$page";
    }

    public function index(MajorOfferDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->majorOfferView('index'), [
            'id' => $id,
        ]);
    }

    public function create($id)
    {
        $sellers = Seller::select("id", "name")->get();

        return view($this->majorOfferView('create'), compact("sellers"))
            ->with('id', $id);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            //
        ], [
            //
        ]);

        $offer = new MajorOffer;

        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'offers');
            $offer->image = $image;
        }

        $offer->seller_id = $request->seller_id;
        $offer->major_id = $id;
        $offer->save();

        return redirect('majorsoffers/' . $offer->major_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = MajorOffer::where('id', $id)->first();

        $sellers = Seller::select("id", "name")->get();

        return view($this->majorOfferView('edit'), compact("sellers", "offer"));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            //
        ], [
            //
        ]);

        $offer = MajorOffer::where('id', $id)->first();

        if ($request->hasFile('image')) {
            File::delete(public_path() . '/uploads/' . $offer->image);

            $image = $this->uploadimage($request->image, 'offers');
            $offer->image = $image;
        }

        $offer->seller_id = $request->seller_id;
        $offer->save();

        return redirect('majorsoffers/' . $offer->major_id);
    }

    public function destroy($id)
    {
        $offer = MajorOffer::where('id', $id)->first();

        File::delete(public_path() . '/uploads/' . $offer->image);

        $offer->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
