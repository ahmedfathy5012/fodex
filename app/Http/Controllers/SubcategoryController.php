<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Major;
use App\traits\generaltrait;
use App\DataTables\SubcategoryDataTable;
use Illuminate\Support\Facades\File;

class SubcategoryController extends Controller
{
    use generaltrait;

    private function subcategoryView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.subcategories.$page"
            : "admindashboard.subcategories.V2.$page";
    }

    public function index(SubcategoryDataTable $dataTable)
    {
        return $dataTable->render($this->subcategoryView('index'));
    }

    public function create()
    {
        $majors = Major::all();
        $categories = Category::where("is_subcategory", 1)->get();

        return view($this->subcategoryView('create'))
            ->with('majors', $majors)
            ->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $subcategory = new Subcategory;
        $subcategory->title = $request->title;

        $category = Category::where("id", $request->category_id)->first();

        $subcategory->major_id = $category->major_id;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'subcategories');
            $subcategory->image = $image;
        }

        $subcategory->save();

        return redirect()->route('subcategory.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $majors = Major::all();
        $categories = Category::where("is_subcategory", 1)->get();

        $subcategory = Subcategory::where('id', $id)->first();

        return view($this->subcategoryView('edit'))
            ->with('majors', $majors)
            ->with('categories', $categories)
            ->with('subcategory', $subcategory);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $subcategory = Subcategory::where('id', $id)->first();

        $subcategory->title = $request->title;

        $category = Category::where("id", $request->category_id)->first();

        $subcategory->major_id = $category->major_id;
        $subcategory->category_id = $request->category_id;
        $subcategory->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $this->uploadimage($request->image, 'subcategories');
            $subcategory->image = $image;
        }

        $subcategory->save();

        return redirect()->route('subcategory.index');
    }

    public function destroy($id)
    {
        $subcategory = Subcategory::where('id', $id)->first();

        File::delete(public_path() . '/uploads/' . $subcategory->image);

        $subcategory->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
