<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Reactive;
use Validator;
use function dd;

class UsefulnessAI extends Controller
{



    public static function prompt($prompt){
        $http_message = Http::post('http://localhost:8000/review', $prompt);
        $json_body = $http_message->json();

            return $json_body;
        dd($json_body);
        $validator = Validator::make($json_body, [
            "type" => "required|string",
            "body" => "string"
        ]);
        if($validator->fails()){
            // AI Returned bad response
            dd(["Bad", $json_body]);
        } else {
        }
    }
}
