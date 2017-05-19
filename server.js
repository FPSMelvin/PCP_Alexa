var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(8085);

function handler (req, res) {
  fs.readFile(__dirname + '/test.html',
  function (err, data) {
    if (err) {
      res.writeHead(500);
      return res.end('Error loading test.html');
    }

    res.writeHead(200);
    res.end(data);
  });
}

var woord;

io.on('connection', function (socket) {

    console.log('New client connected');

    socket.on('test', function (data) {
      console.log(data);
      woord = data;
      sockets.emit('test2', woord);
    });

    socket.on('disconnect', function() {
        console.log('disconnected');
    });

});
