<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Conversation;

class ChatController extends Controller
{
    protected $conversation, $message;

    public function __construct(Conversation $conversation, Message $message) {
        $this->conversation = $conversation;
        $this->message = $message;
    }

    public function message(Request $request){
        try {
            $conversation = $this->conversation->createConversation($request);
            return $this->message->sendMessageToUser($request, $conversation);            
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured '. $e->getMessage(), 'status' => 400], 400);
        }
    }

    public function getAllConversation(Request $request){
        try {
            return $this->message->getAllConversation(auth()->user()->id, $request->reciever_id);            
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occured '. $e->getMessage(), 'status' => 400], 400);
        }
    }
}
