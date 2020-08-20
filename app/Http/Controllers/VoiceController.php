<?php

namespace App\Http\Controllers;

use App\Voice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

class VoiceController extends Controller
{
    public function putVote(Request $request) {
        $vote = App\Voice::selectVote(Auth::user()->id, $request->article_id)->first();
        if ($vote) {
            switch ($request->vote){
                case 'like':
                    if ($vote->vote == 0) App\Voice::updateVote(Auth::user()->id, $request->article_id, 1);
                    if ($vote->vote == -1) App\Voice::updateVote(Auth::user()->id, $request->article_id, 0);
                break;
                case 'dislike':
                    if ($vote->vote == 1) App\Voice::updateVote(Auth::user()->id, $request->article_id, 0);
                    if ($vote->vote == 0) App\Voice::updateVote(Auth::user()->id, $request->article_id, -1);
                break;
            }
        } else {
            switch ($request->vote){
                case 'like':
                    App\Voice::insertVote(Auth::user()->id, $request->article_id, 1);
                break;
                case 'dislike':
                    App\Voice::insertVote(Auth::user()->id, $request->article_id, -1);
                break;
            }
        }
        return back()->with(["message" => "Спасибо за голос"]);
    }
}
