<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\DataTables\RoleDataTable;

class RoleController extends Controller
{
    private function roleView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.roles.$page"
            : "admindashboard.roles.V2.$page";
    }

    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render($this->roleView('index'));
    }

    public function create()
    {
        return view($this->roleView('create'));
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        if ($request->permissions) {
            $role->attachPermissions($request->permissions);
        }

        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::where('id', $id)->first();

        return view($this->roleView('edit'))
            ->with('role', $role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();

        $role->name = $request->name;
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::where('id', $id)->first();

        $role->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
