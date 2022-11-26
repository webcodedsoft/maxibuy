<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\PubSub\PubSubClient;

class PublisherController extends Controller
{
    /**
     * POST /publish
     * Send a message to the topic
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish(Request $request, $topic)
    {
        try {
            $requestData = $request->input('data');
            $request->validate([
                'data' => 'required',
            ]);
            $pubSubClient = new PubSubClient([
                'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
            ]);
            $data = json_encode($requestData);
            $response = $pubSubClient->topic($topic)
                ->publish([
                    'data' => $data,
                ]);

            return response()->json(['data' => $requestData, 'topic' => $topic], 200);

        } catch (\Exception $e) {
            response()->json(["data" => $requestData, "topic" => $topic,
             "errorMessage" => $e->getMessage()], 400)->send();
        }
    }
}
