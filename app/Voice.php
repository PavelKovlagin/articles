<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App;

class Voice extends Model
{
    protected static function getArticleLike($article_id) {
        $countArticleLike = DB::table("voices")
        ->join('articles', 'article_id', '=', 'articles.id')
        ->where([
            ['articles.id', '=', $article_id],
            ['voices.vote', '=', 1]
        ])
        ->count();
        return $countArticleLike;
    }

    protected static function getArticleDislike($article_id) {
        $countArticleLike = DB::table("voices")
        ->join('articles', 'article_id', '=', 'articles.id')
        ->where([
            ['articles.id', '=', $article_id],
            ['voices.vote', '=', 1]
        ])
        ->count();
        return $countArticleLike;
    }    

    protected static function selectVote($user_id, $article_id) {
        $vote = DB::table('voices')
        ->where([
            ['voices.user_id', '=', $user_id],
            ['voices.article_id', '=', $article_id]
        ]);
        return $vote;
    }

    protected static function insertVote($user_id, $article_id, $vote) {
        $voice = new App\Voice;
        $voice->user_id = $user_id;
        $voice->article_id = $article_id;
        $voice->vote = $vote;
        $voice->save();
        return $voice->id; 
    }

    protected static function updateVote($user_id, $article_id, $vote) {
        DB::table('voices')
            ->where([
            ['voices.user_id', '=', $user_id],
            ['voices.article_id', '=', $article_id]
        ])
        ->update(array('vote' => $vote));
    }    
}
