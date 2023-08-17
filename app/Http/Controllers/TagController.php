<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\DataTables\TagDataTable;
class TagController extends Controller
{
     public function index(TagDataTable $dataTable)
    {
      // dd(Country::all());
        return $dataTable->render('admindashboard.tags.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('admindashboard.tags.create');
  }

 
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $tag = new Tag;
    $tag->title = $request->title;
    $tag->save();
    return redirect()->route('tags.index');
  }

 
  public function edit($id)
  {
    $tag = Tag::where('id',$id)->first();
    return view('admindashboard.tags.edit')->with('tag',$tag); 
  }
  public function update(Request $request,$id)
  {
      $request->validate([
      'title' => 'required'],[
      'title.required' => 'هذا الحقل مطلوب'
       ]);
    $tag = Tag::where('id',$id)->first();
    $tag->title = $request->title;
    $tag->save();
    return redirect()->route('tags.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
     $tag = Tag::where('id',$id)->first();
     $tag->delete();
     return response()->json(['status' => true]);
  }
}
