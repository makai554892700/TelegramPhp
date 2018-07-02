<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Jobs\TelegramJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function sendMessage(Request $request)
    {
        $username = $request->input('username');
        $message = $request->input('message');
        Log::error('-----------username=' . $username . ';message=' . $message);
        $job = (new TelegramJob("sendMessage", $username, $message))->onQueue("");
        dispatch($job);
        return "ok";
    }

}