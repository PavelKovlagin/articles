@extends('layouts/layout')
@section('title')
Articles
@endsection
@section('content')
<script
			  src="https://code.jquery.com/jquery-2.2.4.js"
			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
			  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <ul class="chat"></ul>
    <br>
    <form>
        <textarea style="width:100%;height:50px"></textarea>
        <input type='submit' value='Отправить'>
    </form>  

<script>
    var socket = io(':6001');
    // socket.on('message', function(data){
    //     console.log('From server', data);
    // });
    // socket.on('server-info', function(data){
    //     console.log('FrOm SeRvEr: ', data)
    // });
    function appendMessage(data) {
        $('.chat').append(
            $('<li>').text(data.message)
        );
    }

    $('form').on('submit', function(){
        var text = $('textarea').val(),
            msg = {message : text};
        if (msg.message.length <= 0) {
            alert('Заполните сообщение');
        } else {
            socket.send(msg);
            appendMessage(msg);
            $('textarea').val('')
        }
        return false;
    })

    socket.on('message', function(data){
        appendMessage(data);
    })


</script>
@endsection('content')
     