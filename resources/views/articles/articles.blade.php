@extends('layouts/layout')
@section('title')
{{$title}}
@endsection
@section('content')
<p class="error">{{session("message")}}</p>
<h1>{{$title}}</h1>
@if (Auth::check())
    <button type="submit" onclick="location.href='/articles/addArticle'">Добавить статью</button>
@endif

@if(count($articles)>0)    
    <table border="1">
        <tr>
            <th> Название статьи </th>
            <th> Описание статьи </th>
            <th> Автор статьи </th>
            <th> Рейтинг </th>
        </tr>
        @foreach ($articles as $article)
        <tr>
            <th> {{$article->article_name}} </th>            
            <th> {{$article->article_description}} </th>
            <th> {{$article->user_name}} {{$article->user_surname}} </th>
            <th> @if ($article->rating == null) 0 @else {{$article->rating}} @endif </th>
            <th> <a href="/articles/{{$article->article_id}}"> Подробно </a></th>
        </tr>
        @endforeach
    </table>
    @else
    <h1>Статей нет</h1>
    @endif
@endsection