
// Let’s make node/socketio listen on port 3000
var io = require('socket.io').listen(3000)

var notes = []

io.sockets.on('connection', function(socket){

    socket.on('disconnect', function() {
      console.log('disconnected');
    })

    console.log('testtt');

});
