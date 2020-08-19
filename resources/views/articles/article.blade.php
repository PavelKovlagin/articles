@extends('layouts/layout')
@section('title')
{{$article->article_name}}
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$article->article_name}}</div>                      
                    <div class="card-body">
                        <div class="col-md-12">
                        <p class="error">{{session("message")}}</p> 
                            <p class="error"> {{session('error')}} </p>
                            <p> Автор:  {{$article->user_name}} {{$article->user_surname}}</p>                           
                            @if (($authUser <> false))         

                                <form action="/updateArticle" method="POST">
                                @csrf
                                <input  type="hidden" name="article_id" value="{{$article->article_id}}">    
                                <p> Название статьи: <input class="form-control" type="text" size=50 name="article_name" value="{{$article->article_name}}" required> </p>
                                <p>Описание:</p>
                                <textarea required class="form-control" name="article_description" cols="50" rows="10">{{$article->article_description}}</textarea> <br>                                    
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Обновить</button>
                                </form>                            
                            @else    
                                <p> Название статьи: {{$article->article_name}} </p>
                                <p> Описание: {{$article->article_description}} </p>  
                            @endif
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection