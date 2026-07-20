<?php

namespace App\Http\Controllers;

use App\DataTables\ZoneOrderDataTable;
use App\Models\Zone;

class ZoneOrderController extends Controller
{
    private function reportView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.reports.zone_orders.$page"
            : "admindashboard.reports.zone_orders.V2.$page";
    }

    public function index(ZoneOrderDataTable $dataTable)
    {
        $zones = Zone::all();

        return $dataTable->render($this->reportView('orders'), ['zones' => $zones]);
    }
}
