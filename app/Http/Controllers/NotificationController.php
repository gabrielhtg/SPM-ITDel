<?php

namespace App\Http\Controllers;

use App\Models\NotificationModel;
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
}
