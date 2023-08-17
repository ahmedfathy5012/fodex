<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coin;
use App\DataTables\CoinDataTable;
class CoinController extends Controller
{
     public function index(CoinDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.coins.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.coins.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $coin = new Coin;
    $coin->title = $request->title;
    $coin->save();
    return redirect()->route('coins.index');
  }

 
  public function edit($id)
  {
    $coin = Coin::where('id',$id)->first();
    return view('admindashboard.coins.edit')->with('coin',$coin); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $coin = Coin::where('id',$id)->first();
    $coin->title = $request->title;
    $coin->save();
    return redirect()->route('coins.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $coin = Coin::where('id',$id)->first();
     $coin->delete();
     return response()->json(['status' => true]);
  }
}
