<?php

namespace App\Http\Controllers;

use App\Notifications\GoogleChatCardNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    public function test()
    {
        Notification::send(null, new GoogleChatCardNotification(['channel' => 'develop']));
    }
}
