<?php

namespace App\Http\Controllers;

use App\Models\NotificationModel;
use App\Services\AllServices;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications(Request $request) {
        $notification = NotificationModel::find($request->id);

        if (!$notification->clicked) {
            $notification->update([
                'clicked' => true
            ]);
        }

        return redirect()->route($notification->ref_link);
    }

    public function markAllAsRead()
    {
        $notifications = NotificationModel::all();
        $temp = [];

        for ($i = 1; $i <= 5; $i++) {
            if ((count($notifications) - $i) > -1) {
                if ($notifications[count($notifications) - $i]->to == auth()->user()->id) {
                    $temp[] = $notifications[count($notifications) - $i];
                }

                if (AllServices::isLoggedUserHasAdminAccess() == $notifications[count($notifications) - $i]->admin_only) {
                    $temp[] = $notifications[count($notifications) - $i];
                }
            }
        }

        foreach ($temp as $e) {
            $e->update([
                'clicked' => true,
            ]);
        }

        return redirect()->back();
    }

    public function getNotificationPage() {
        $data = [
            'notifications' => AllServices::getAllNotifications(),
            'active_sidebar' => [0, 0]
        ];

        return view('notification', $data);
    }
}
