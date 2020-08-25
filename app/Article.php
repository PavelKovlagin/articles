<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App;
use DB;

class Article extends Model
{
    protected static function selectArticles() {
        $articles = DB::select(
            "SELECT 
            articles.id as article_id,
            articles.name as article_name ,
            description as article_description,
            users.id as user_id,
            users.name as user_name,
            surname as user_surname,
            address as user_address,
            email as user_email,
            (SELECT sum(voices.vote = 1) FROM articles.voices WHERE articles.id = voices.article_id) -
            (SELECT sum(voices.vote = -1) FROM articles.voices WHERE articles.id = voices.article_id) as `rating`
            FROM articles.articles, articles.users WHERE articles.user_id = users.id
            ORDER BY rating DESC;"
        );
        // $articles = DB::table('articles')
        // ->join('users', 'user_id', '=', "users.id")
        // ->crossJoin('voices')
        // ->select(
        //     'articles.id as article_id',
        //     'articles.name as article_name',
        //     'description as article_description',
        //     'users.id as user_id',
        //     'users.name as user_name',
        //     'surname as user_surname',
        //     'address as user_address',
        //     'email as user_email',
        //     DB::raw('sum(voices.like) WHERE voices.article_id = articles.id as likes')
        // )
        // ->groupBy('articles.id');

        return $articles;
    }

    protected static function selectArticle($article_id) {
        // $article = Article::selectArticles()
        // ->where('articles.id', '=', $article_id);
        // return $article;
        $article = DB::select(
            "SELECT 
            articles.id as article_id,
            articles.name as article_name ,
            description as article_description,
            users.id as user_id,
            users.name as user_name,
            surname as user_surname,
            address as user_address,
            email as user_email,
            (SELECT sum(voices.vote = 1) FROM articles.voices WHERE articles.id = voices.article_id) as `likes`,
            (SELECT sum(voices.vote = -1) FROM articles.voices WHERE articles.id = voices.article_id) as `dislikes`
            FROM articles.articles, articles.users 
            WHERE articles.user_id = users.id AND articles.id = $article_id;"
        );
        return $article[0];
    }

    protected static function updateArticle($request) {
        $article = DB::table('articles')
        ->where('articles.id', '=', $request->article_id)
        ->update(array('name' => $request->article_name,
                        'description' => $request->article_description,

        ));
        return $request->artucle_id;
    }

    protected static function insertArticle($user_id, $request) {
        $article = new App\Article;
        $article->user_id = $user_id;
        $article->name = $request->article_name;
        $article->description = $request->article_description;
        $article->save();
        return $article;
    }
}
