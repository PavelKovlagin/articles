<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\Events\onAddArticle;
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
<<<<<<< HEAD
<<<<<<< 84aa1f198760aee8566699176f2e06e49f7da400
<<<<<<< 84aa1f198760aee8566699176f2e06e49f7da400
        $vote = App\Voice::selectVote($authUser->user_id, $article->article_id)->first();
=======
=======
>>>>>>> Refactoring
=======
>>>>>>> master
        if ($authUser <> false) {
            $vote = App\Voice::selectVote($authUser->user_id, $article->article_id)->first();
        } else {
            $vote = null;
<<<<<<< HEAD
<<<<<<< 84aa1f198760aee8566699176f2e06e49f7da400
        }       
        
>>>>>>> log, events, listeners
=======
        }        
>>>>>>> Refactoring
=======
        }       
        
>>>>>>> master
        return view("articles.article", [
            'authUser' => $authUser,
            'article' => $article,
            'vote' => $vote
        ]);
    }

    public function insertArticle(Request $request) {
        $authUser = App\User::selectAuthUser();         
        if ($authUser <> false) {
            $article = App\Article::insertArticle($authUser->user_id, $request);
            event(new onAddArticle($article, $authUser)); 
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
        //return dd($article->article_name);
        if ($article && $authUser->user_id == $article->user_id) {
            App\Article::updateArticle($request);
            event('onUpdateArticle', [$article, $authUser, $request->article_name]);
            return back()->with(["message" => "Статья обновлени"]);
        } else {
            return back()->with(["message" => "Статья не обновлена"]);
        }
    }
}
