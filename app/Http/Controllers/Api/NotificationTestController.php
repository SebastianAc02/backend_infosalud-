<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationTestController extends Controller
{
    public function testWhatsApp(Request $request, NotificationService $notifier)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string'
        ]);
        $ok = $notifier->sendWhatsApp($request->phone, $request->message);
        return response()->json(['sent' => $ok], $ok ? 200 : 500);
    }

    public function testSMS(Request $request, NotificationService $notifier)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string'
        ]);
        $ok = $notifier->sendSMS($request->phone, $request->message);
        return response()->json(['sent' => $ok], $ok ? 200 : 500);
    }


}
