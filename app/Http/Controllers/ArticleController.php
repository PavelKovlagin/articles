<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use DB;
use App;

class ArticleController extends Controller
{
    public function showArticles(){
        $articles = App\Article::selectArticles()->get();
        return view("articles.articles", [
        'title' => 'Статьи',
        'articles' => $articles
    ]);
    }

    public function showArticle($article_id) {
        $article = App\Article::selectArticle($article_id)->first();
        $authUser = App\User::selectAuthUser();
        return view("articles.article", [
            'authUser' => $authUser,
            'article' => $article
        ]);
    }

    public function insertArticle(Request $request) {
        $authUser = App\User::selectAuthUser();
        if ($authUser <> false) {
            App\Article::insertArticle($authUser->user_id, $request);
            return redirect('/articles');
        } else {             
            return back()->with(["message" => "Пользователь не авторизован"]);
        }
    }

    public function updateArticle(Request $request) {
        $authUser = App\User::selectAuthUser();
        $article = App\Article::selectArticle($request->article_id)->first();
        if ($article && $authUser->user_id == $article->user_id) {
            App\Article::updateArticle($request);
            return back()->with(["message" => "Статья обновлени"]);
        } else {
            return back()->with(["message" => "Статья не обновлена"]);
        }
    }
}
