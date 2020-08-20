<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use DB;
use App;

class ArticleController extends Controller
{
    public function showArticles(){
        $articles = App\Article::selectArticles();
        return view("articles.articles", [
        'title' => 'Статьи',
        'articles' => $articles
    ]);
    }

    public function showArticle($article_id) {
        $article = App\Article::selectArticle($article_id);
        $authUser = App\User::selectAuthUser();
        $vote = App\Voice::selectVote($authUser->user_id, $article->article_id)->first();
        return view("articles.article", [
            'authUser' => $authUser,
            'article' => $article,
            'vote' => $vote
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

    public function deleteArticle(Request $request) {
        $authUser = App\User::selectAuthUser();
        $article = App\Article::selectArticle($request->article_id);
        if ($authUser->user_id == $article->user_id) {
            App\Article::destroy($article->article_id);
            return redirect('/articles')->with(["message" => "Статья удалена"]);
        } else {
            return back()->with(["message" => "Ошшибка удаления статьи"]);
        }
    }

    public function updateArticle(Request $request) {
        $authUser = App\User::selectAuthUser();
        $article = App\Article::selectArticle($request->article_id);
        if ($article && $authUser->user_id == $article->user_id) {
            App\Article::updateArticle($request);
            return back()->with(["message" => "Статья обновлени"]);
        } else {
            return back()->with(["message" => "Статья не обновлена"]);
        }
    }
}
