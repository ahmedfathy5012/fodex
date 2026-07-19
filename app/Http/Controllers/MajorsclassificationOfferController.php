<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MajorsclassificationOffer;
use App\Traits\generaltrait;
use App\DataTables\MajorsclassificationOfferDataTable;
use Illuminate\Support\Facades\File;
use App\Models\Seller;

class MajorsclassificationOfferController extends Controller
{
    use generaltrait;

    private function majorClassificationOfferView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.majorclassification.offers.$page"
            : "admindashboard.majorclassification.offers.V2.$page";
    }

    public function index(MajorsclassificationOfferDataTable $dataTable, $id)
    {
        $dataTable->id = $id;

        return $dataTable->render($this->majorClassificationOfferView('index'), [
            'id' => $id,
        ]);
    }

    public function create($id)
    {
        $sellers = Seller::select("id", "name")->get();

        return view($this->majorClassificationOfferView('create'), compact("sellers"))
            ->with('id', $id);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            //
        ], [
            //
        ]);

        $offer = new MajorsclassificationOffer;
        $offer->majorclassification_id = $id;

        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'offers');
            $offer->image = $image;
        }

        $offer->seller_id = $request->seller_id;
        $offer->save();

        return redirect('majoroffers/' . $id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $offer = MajorsclassificationOffer::where('id', $id)->first();
        $sellers = Seller::select("id", "name")->get();

        return view($this->majorClassificationOfferView('edit'), compact("sellers", "offer"));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            //
        ], [
            //
        ]);

        $offer = MajorsclassificationOffer::where('id', $id)->first();

        if ($request->hasFile('image')) {
            if ($offer->image) {
                File::delete(public_path() . '/uploads/' . $offer->image);
            }

            $image = $this->uploadimage($request->image, 'offers');
            $offer->image = $image;
        }

        $offer->seller_id = $request->seller_id;
        $offer->save();

        return redirect('majoroffers/' . $offer->majorclassification_id);
    }

    public function destroy($id)
    {
        $offer = MajorsclassificationOffer::where('id', $id)->first();

        if ($offer->image) {
            File::delete(public_path() . '/uploads/' . $offer->image);
        }

        $offer->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
