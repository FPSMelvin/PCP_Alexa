var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(80);

function handler (req, res) {
  fs.readFile(__dirname + '/index.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading index.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

// // Let’s make node/socketio listen on port 3000
// var io = require('socket.io').listen(3000);

io.on('connection', function (socket) {

    socket.on('disconnect', function() {
      console.log('disconnected');
    });

    console.log('testtt');

    socket.on('test', function(){
      console.log('testtt');
    });



});
