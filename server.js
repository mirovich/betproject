var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

//Подписываемся на канал
redis.subscribe('some-channel-name');

redis.on('some-message-name', function(channel, message) {
    message = JSON.parse(message);

    //Посылаем на front-end
    io.emit(channel + ':' + message.event, message.data);
});

//Выбираем номер порта
server.listen(3000);
