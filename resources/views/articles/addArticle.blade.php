@extends('layouts/layout')
@section('title')
Добавить статью
@endsection
@section('content')


@if($authUser<>false)
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавить новое событие</div>                
                <div class="card-body">
                    <div class="col-md-12">                        
                        <p class="error">{{session("message")}}</p>
                        <form action="{{ url('/addArticle') }}" method="POST">
                        {{ csrf_field() }} 
                        <p> Название статьи:</p>
                        <input required class="form-control" type="text" name="article_name">
                        <p> Описание статьи:</p>
                        <textarea required class="form-control" type="text" name="article_description"></textarea>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Добавить </button>  
                        </form>    
@else
                        <p class='error'>Вы не авторизованы </p>
@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection