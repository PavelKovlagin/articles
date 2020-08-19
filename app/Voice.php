<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Voice extends Model
{
    protected static function getArticleLike($article_id) {
        $countArticleLike = DB::table("voices")
        ->join('articles', 'article_id', '=', 'articles.id')
        ->where([
            ['articles.id', '=', $article_id],
            ['voices.like', '=', 1]
        ])
        ->count();
        return $countArticleLike;
    }

    protected static function getArticleDislike($article_id) {
        $countArticleLike = DB::table("voices")
        ->join('articles', 'article_id', '=', 'articles.id')
        ->where([
            ['articles.id', '=', $article_id],
            ['voices.like', '=', 1]
        ])
        ->count();
        return $countArticleLike;
    }
}
