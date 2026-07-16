<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppStatus;

class AppStatusController extends Controller
{
    private function appStatusView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.app_status.$page"
            : "admindashboard.app_status.V2.$page";
    }

    public function edit()
    {
        $app_status = AppStatus::firstOrNew();

        return view($this->appStatusView('edit'))
            ->with('app_status', $app_status);
    }

    public function update(Request $request)
    {
        $app_status = AppStatus::firstOrNew();

        $app_status->message = $request->message;

        if ($request->status == 1) {
            $app_status->status = 1;
        } else {
            $app_status->status = 0;
        }

        $app_status->save();

        return redirect()->back()->with([
            'success' => "تم الحفظ بنجاح",
        ]);
    }
}
