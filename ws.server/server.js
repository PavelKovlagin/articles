var io = require('socket.io')(6001);
io.on('connection', function(socket){
    console.log('New connection', socket.id);
    //socket.send('Message  from server');
    //socket.emit('server-info', {version: .1});
    
    //socket.broadcast.send('New user');
    //JOIN TO ROOM
    // socket.join('vip', function(error){
    //     console.log(socket.rooms);
    // })

    socket.on('message', function(data){
        socket.broadcast.send(data);
    })
})