// var fs = require('fs');

//
// var express = require('express');
// var app = express();
//
// var http = require('http');
// //server = http.createServer(app).listen(80);
//
// var options = {
//     key: fs.readFileSync('./privkey.pem'),
//     cert: fs.readFileSync('./cert.pem')
// };

// var forceSsl = require('express-force-ssl');
//
// app.use(forceSsl);

// Create https server

try {
    var https = require('https');
    var express = require('express');
    var app = express();
    var server = https.createServer([], app).listen(8000);
    var io = require('socket.io').listen(server);

    //server = https.createServer(options, app).listen(8000);

    //var io = require('socket.io')(server);

    // http.listen(8000, function () {
    //     console.log('listening on *:8000');
    // });

    app.on('connection', function (socket) {
        console.log('a user connected');
        socket.on('bind-user', function (data) {
            console.log('binded');
            // connection.query('SELECT * from tf_user where id=?', [data.userid], function (error, results, fields) {
            //     if (error) throw error;
            //     if (results[0]) {
            //         connection.query('UPDATE tf_user SET socket=? where id=?', [socket.id, data.userid], function () {
            //             console.log('Updated successfully');
            //         });
            //     }
            // });
        });
    });
} catch (err) {
    console.log('pam');
    console.log(err.message);
    return false;
}


// // var http = require('http').Server(app);
// var mysql = require('mysql');
// var moment = require('moment');
// var chat = require('./classes/chat');
//
// module.exports.https = https;
// module.exports.io = io;
//
// var connection = mysql.createConnection({
//     host: 'localhost',
//     user: 'root',
//     password: '6oghagJ7?kz5',
//     database: 'demopane_teamfight',
//     supportBigNumbers: true,
//     bigNumberStrings: true
// });
//
// connection.connect(function (err) {
//     if (err) {
//         console.error('error connecting: ' + err.stack);
//         return;
//     }
// });
//

//
//     socket.on('message', function (data) {
//         socket.emit('msg-send', {data: 1});
//         connection.query('SELECT * from tf_user where id=?', [data.userid], function (error, results, fields) {
//             if (error) throw error;
//             if (results[0] == undefined) return false;
//             var sender = results[0];
//             connection.query('SELECT tf_user.id as id, name, socket FROM tf_user_to_dialog LEFT JOIN tf_user ON tf_user.id = tf_user_to_dialog.userid where dialogid = ?', [data.dialogid], function (error, results, fields) {
//                 if (error) throw error;
//                 if (results) {
//                     results.forEach(function (user, index) {
//                         // console.log(user);
//                         // console.log(index);
//                         console.log('-----------------');
//                         console.log(user.id);
//                         console.log(sender.id);
//                         console.log('-----------------');
//                         if (parseInt(user.id) == parseInt(data.userid)) {
//                             console.log('In but not sended');
//                             var html = '<div class="clearfix"> <div class="mess_general personal_mess"> <span class="message_time">' + moment(new Date()).format('HH:mm') + '</span> <div>' + data.message + '</div> </div> <div class="clearex"></div> </div>';
//                             // var html = '<div class="clearfix"> <div class="mess_general personal_mess"><span class="nickname"> <a href="http://steamcommunity.com/profiles/'+ sender.steamid +'/" id="user_'+ sender.id +'" target="_blank">'+ sender.name +'</a> <div>'+ data.message +'</div> </span> <span class="message_time">'+ moment(new Date()).format('HH:mm') +'</span> </div> <div class="clearex"></div> </div>';
//                             socket.emit('msg-send', {'message': html, 'message2': 'my test'});
//                         } else {
//                             var html = '<div class="clearfix"> <div class="mess_general mess"><span class="nickname"> <a href="https://steamcommunity.com/profiles/' + String(sender.steamid) + '/" id="user_' + sender.id + '" target="_blank">' + sender.name + '</a> <div>' + data.message + '</div> </span> <span class="message_time">' + moment(new Date()).format('HH:mm') + '</span> </div> <div class="clearex"></div> </div>';
//                             socket.broadcast.to(user.socket).emit('msg-send', {'message': html, 'message2': 'my test', 'test': String(sender.steamid)});
//                         }
//                     });
//                 }
//             });
//         });
//     });
// });
