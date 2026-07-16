<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageCategory;
use App\DataTables\PackageCategoryDataTable;

class PackageCategoryController extends Controller
{
    private function packageCategoryView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.packagescategories.$page"
            : "admindashboard.packagescategories.V2.$page";
    }

    public function index(PackageCategoryDataTable $dataTable)
    {
        return $dataTable->render($this->packageCategoryView('index'));
    }

    public function create()
    {
        return view($this->packageCategoryView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $packagescategories = new PackageCategory;
        $packagescategories->title = $request->title;
        $packagescategories->save();

        return redirect()->route('packagescategories.index');
    }

    public function edit($id)
    {
        $packagescategories = PackageCategory::where('id', $id)->first();

        return view($this->packageCategoryView('edit'))
            ->with('packagescategories', $packagescategories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $packagescategories = PackageCategory::where('id', $id)->first();
        $packagescategories->title = $request->title;
        $packagescategories->save();

        return redirect()->route('packagescategories.index');
    }

    public function destroy($id)
    {
        $packagescategories = PackageCategory::where('id', $id)->first();
        $packagescategories->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
