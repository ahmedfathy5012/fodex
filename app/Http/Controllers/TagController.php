<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\DataTables\TagDataTable;

class TagController extends Controller
{
    private function tagView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.tags.$page"
            : "admindashboard.tags.V2.$page";
    }

    public function index(TagDataTable $dataTable)
    {
        return $dataTable->render($this->tagView('index'));
    }

    public function create()
    {
        return view($this->tagView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $tag = new Tag;
        $tag->title = $request->title;
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function edit($id)
    {
        $tag = Tag::where('id', $id)->first();

        return view($this->tagView('edit'))
            ->with('tag', $tag);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $tag = Tag::where('id', $id)->first();
        $tag->title = $request->title;
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        $tag = Tag::where('id', $id)->first();
        $tag->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
