<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Notification;
use App\User;
use App\Models\Driver;
use App\Models\Country;
use App\Models\City;
use App\Models\State;
use App\Models\Zone;
use App\Models\Address;
use App\traits\generaltrait;
use App\Services\SendNotification;

class NotificationController extends Controller
{
    use generaltrait;

    private function notificationView(string $page): string
    {
        return env('APP_ENV') == 'production'
            ? "admindashboard.notifications.$page"
            : "admindashboard.notifications.V2.$page";
    }

    public function notification()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        return view($this->notificationView('sendnotification'), compact("countries", "states", "cities", "zones"));
    }

    public function storenotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
        ], [
            'text.required' => 'حقل النص مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
        ]);

        if ($validator->passes()) {
            $users = User::whereHas("address", function ($query) use ($request) {
                $query->when($request->country_id != 0, function ($q) use ($request) {
                    return $q->where("country_id", $request->country_id);
                });

                $query->when($request->state_id != 0, function ($q) use ($request) {
                    return $q->where("state_id", $request->state_id);
                });

                $query->when($request->city_id != 0, function ($q) use ($request) {
                    return $q->where("city_id", $request->city_id);
                });

                $query->when($request->zone_id != 0, function ($q) use ($request) {
                    return $q->where("zone_id", $request->zone_id);
                });
            })->get();

            foreach ($users as $user) {
                $notification = new Notification;
                $notification->user_id = $user->id;
                $notification->title = $request->title;
                $notification->text = $request->text;
                $notification->save();

                $to = $user->device_token;
                $noti_class = new SendNotification;
                $noti_class->send($to, $notification->title, $notification->text);
            }

            return response()->json(['status' => true, 'message' => 'تم ارسال الاشعارات بنجاح']);
        }

        return response()->json(['status' => false, 'message' => $validator->messages()->first()]);
    }

    public function notificationdriver()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $zones = Zone::all();

        return view($this->notificationView('sendnotificationdriver'), compact("countries", "states", "cities", "zones"));
    }

    public function storenotificationdriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
        ], [
            'text.required' => 'حقل النص مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
        ]);

        if ($validator->passes()) {
            $drivers = Driver::whereHas("address", function ($query) use ($request) {
                $query->when($request->country_id != 0, function ($q) use ($request) {
                    return $q->where("country_id", $request->country_id);
                });

                $query->when($request->state_id != 0, function ($q) use ($request) {
                    return $q->where("state_id", $request->state_id);
                });

                $query->when($request->city_id != 0, function ($q) use ($request) {
                    return $q->where("city_id", $request->city_id);
                });

                $query->when($request->zone_id != 0, function ($q) use ($request) {
                    return $q->where("zone_id", $request->zone_id);
                });
            })->get();

            foreach ($drivers as $user) {
                $notification = new Notification;
                $notification->driver_id = $user->id;
                $notification->title = $request->title;
                $notification->text = $request->text;
                $notification->save();

                $to = $user->device_token;
                $noti_class = new SendNotification;
                $noti_class->send($to, $notification->title, $notification->text);
            }

            return response()->json(['status' => true, 'message' => 'تم ارسال الاشعارات بنجاح']);
        }

        return response()->json(['status' => false, 'message' => $validator->messages()->first()]);
    }

    public function senddriversnoti()
    {
        $drivers = Driver::select("name", "id")->where("is_company", 0)->get();

        return view($this->notificationView('senddriversnoti'), compact("drivers"));
    }

    public function storedriversnoti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
            'driver_ids' => 'required|array|min:1',
        ], [
            'text.required' => 'حقل النص مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'driver_ids.required' => 'حقل السائقين مطلوب',
            'driver_ids.array' => 'حقل السائقين مطلوب',
            'driver_ids.min' => 'يجب اختيار سائق واحد على الأقل',
        ]);

        if ($validator->passes()) {
            $drivers = Driver::whereIn("id", $request->driver_ids)->get();

            foreach ($drivers as $user) {
                $notification = new Notification;
                $notification->driver_id = $user->id;
                $notification->title = $request->title;
                $notification->text = $request->text;
                $notification->save();

                $to = $user->device_token;
                $noti_class = new SendNotification;
                $noti_class->send($to, $notification->title, $notification->text);
            }

            return response()->json(['status' => true, 'message' => 'تم ارسال الاشعارات بنجاح']);
        }

        return response()->json(['status' => false, 'message' => $validator->messages()->first()]);
    }

    public function sendusersnoti()
    {
        $users = User::select("name", "id")->get();

        return view($this->notificationView('sendusersnoti'), compact("users"));
    }

    public function storeusersnoti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
            'user_ids' => 'required|array|min:1',
        ], [
            'text.required' => 'حقل النص مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'user_ids.required' => 'حقل المستخدمين مطلوب',
            'user_ids.array' => 'حقل المستخدمين مطلوب',
            'user_ids.min' => 'يجب اختيار مستخدم واحد على الأقل',
        ]);

        if ($validator->passes()) {
            $users = User::whereIn("id", $request->user_ids)->get();

            foreach ($users as $user) {
                $notification = new Notification;
                $notification->user_id = $user->id;
                $notification->title = $request->title;
                $notification->text = $request->text;
                $notification->save();

                $to = $user->device_token;
                $noti_class = new SendNotification;
                $noti_class->send($to, $notification->title, $notification->text);
            }

            return response()->json(['status' => true, 'message' => 'تم ارسال الاشعارات بنجاح']);
        }

        return response()->json(['status' => false, 'message' => $validator->messages()->first()]);
    }

    public function sendcompanysnoti()
    {
        $drivers = Driver::select("name", "id")->where("is_company", 1)->get();

        return view($this->notificationView('sendcompanysnoti'), compact("drivers"));
    }

    public function storecompanysnoti(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required',
            'driver_ids' => 'required|array|min:1',
        ], [
            'text.required' => 'حقل النص مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'driver_ids.required' => 'حقل شركات التوصيل مطلوب',
            'driver_ids.array' => 'حقل شركات التوصيل مطلوب',
            'driver_ids.min' => 'يجب اختيار شركة توصيل واحدة على الأقل',
        ]);

        if ($validator->passes()) {
            $drivers = Driver::whereIn("id", $request->driver_ids)->get();

            foreach ($drivers as $user) {
                $notification = new Notification;
                $notification->driver_id = $user->id;
                $notification->title = $request->title;
                $notification->text = $request->text;
                $notification->save();

                $to = $user->device_token;
                $noti_class = new SendNotification;
                $noti_class->send($to, $notification->title, $notification->text);
            }

            return response()->json(['status' => true, 'message' => 'تم ارسال الاشعارات بنجاح']);
        }

        return response()->json(['status' => false, 'message' => $validator->messages()->first()]);
    }
}
