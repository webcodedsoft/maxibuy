<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\PubSub\PubSubClient;

class SubscriberController extends Controller
{
    /**
     * POST /pull
     * Pull and acknowledge the messages that were sent to the topic
     *
     * @return void
     */
    public function subscribe(Request $request, $topic)
    {
        try {
            $requestData = $request->input('url');
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $request->validate([
            'url' => 'required|regex:'.$regex,
        ]);

        $pubSubClient = new PubSubClient([
            'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
        ]);

        $subscription = $pubSubClient->subscription($topic);

        $messages = $subscription->pull();
        $response = '';

        foreach ($messages as $message) {
            $response = $message->data();
            $subscription->acknowledge($message);
        }
        if($response) {
            response()->json(["data" => $requestData, "topic" => $topic], 200)->send();
        } else {
            response()->json(["data" => $requestData, "topic" => $topic], 404)->send();
        }
        } catch (\Exception $e) {
            response()->json(["data" => $requestData, "topic" => $topic,
             "errorMessage" => $e->getMessage()], 400)->send();
        }
    }
}
