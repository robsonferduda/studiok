var liveapp = require('express')();
var server = require('http').Server(liveapp);
//node js active users counter
var io = require('socket.io')(server);
//nodejs socket.io online users counter
server.listen(8080);
var flags = 0;
var $ipsConnected = [];
io.on('connection', function (socket) {
  var $liveIpAddress = socket.handshake.address;
  //check socket io online users
  if (!$ipsConnected.hasOwnProperty($liveIpAddress)) {
  	$ipsConnected[$liveIpAddress] = 1;
  	flags++;
	//socket io real time online users example
  	socket.emit('socket_io_counter', {flags:flags});
  }
  console.log("Good Luck, client is connected");
  /* Your Live (socket.io client flags) Disconnect socket */
  socket.on('disconnect', function() {
  	if ($ipsConnected.hasOwnProperty($liveIpAddress)) {
  		delete $ipsConnected[$liveIpAddress];
	    flags--;
	    socket.emit('socket_io_counter', {flags:flags});
  	}
  });
});