<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\DataTables\OrderStatusDataTable;

class OrderStatusController extends Controller
{
    private function orderStatusView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.orderstatus.$page"
            : "admindashboard.orderstatus.V2.$page";
    }

    public function index(OrderStatusDataTable $dataTable)
    {
        return $dataTable->render($this->orderStatusView('index'));
    }

    public function create()
    {
        return view($this->orderStatusView('create'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $orderstatus = new OrderStatus;
        $orderstatus->title = $request->title;
        $orderstatus->save();

        return redirect()->route('orderstatus.index');
    }

    public function edit($id)
    {
        $orderstatus = OrderStatus::where('id', $id)->first();

        return view($this->orderStatusView('edit'))
            ->with('orderstatus', $orderstatus);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'هذا الحقل مطلوب',
        ]);

        $orderstatus = OrderStatus::where('id', $id)->first();
        $orderstatus->title = $request->title;
        $orderstatus->save();

        return redirect()->route('orderstatus.index');
    }

    public function destroy($id)
    {
        $orderstatus = OrderStatus::where('id', $id)->first();
        $orderstatus->delete();

        return response()->json([
            'status' => true,
        ]);
    }
}
