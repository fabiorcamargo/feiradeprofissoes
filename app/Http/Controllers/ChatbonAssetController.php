<?php

namespace App\Http\Controllers;

use App\Models\ChatbotAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbonAssetController extends Controller
{
    public function chatbot_send ($chip, $number, $message){

        $ativo = ChatbotAsset::find($chip);

        $response = Http::withHeaders([
            'Authorization' => $ativo->token
        ])->post('https://v5.chatpro.com.br/' . $ativo->asset . '/api/v1/send_message', [
            "number" => $number,
            "message" => $message
        ]);


        //dd($response->getBody());
    }
}
