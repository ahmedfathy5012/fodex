<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use App\DataTables\CoinDataTable;

class CoinController extends Controller
{
    private function coinView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.coins.$page"
            : "admindashboard.coins.V2.$page";
    }

    public function index(CoinDataTable $dataTable)
    {
        return $dataTable->render($this->coinView('index'));
    }

    public function create()
    {
        return view($this->coinView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $coin = new Coin;
        $coin->title = $request->title;
        $coin->save();

        return redirect()->route('coins.index');
    }

    public function edit($id)
    {
        $coin = Coin::where('id', $id)->first();

        return view($this->coinView('edit'))
            ->with('coin', $coin);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $coin = Coin::where('id', $id)->first();
        $coin->title = $request->title;
        $coin->save();

        return redirect()->route('coins.index');
    }

    public function destroy($id)
    {
        $coin = Coin::where('id', $id)->first();
        $coin->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
