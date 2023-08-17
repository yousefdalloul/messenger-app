<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class conversationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->conversations()->paginate();
    }

    public function show(Conversation $conversation)
    {
        return $conversation->load('participates');
    }
    public function addParticipates(Request $request,Conversation $conversation)
    {
        $request->validate([
            'user_id'=>['required','int','exists:users,id'],
        ]);
        $conversation->participants()->attach($request->post('user_id'),[
            'joined_at'=>Carbon::now(),
        ]);
    }
    public function removeParticipates(Request $request,Conversation $conversation)
    {
        $request->validate([
            'user_id'=>['required','int','exists:users,id'],
        ]);
        $conversation->participants()->detach($request->post('user_id'));
    }
}
