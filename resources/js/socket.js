window.onload = function() {
    socket = io.connect('http://localhost:3003', {rememberTransport: false});
    socket.on('online', function(t){
        // console.log('online');
        updateOnline(t)
    });

};

var updateOnline = function(t) {
    var e = count.online;
    count.online = t,
    $("#online-counter").text(count.online + 200)
}


