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

io.on('connection', function (socket) {

    console.log('Node server started');

    socket.on('test', function(){
        console.log('testtt');
    });

    socket.on('disconnect', function() {
        console.log('disconnected');
    });

});
