var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(8085);

function handler (req, res) {
  fs.readFile(__dirname + '/PCP_APP1/www/iphone.html',
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

    console.log('New client connected');

    socket.on('test', function(data){
        console.log(data);
    });

    // socket.on('test', function (data) {
    //   console.log(data);
    //   socket.emit('test2', 'test2');
    // });
    //
    socket.on('disconnect', function() {
        console.log('disconnected');
    });

});