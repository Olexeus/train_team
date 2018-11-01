// (function ($) {

//     var chat = {
//         init: function (socket) {
//             this.socket = socket;
//             console.log('Chat inited');
//             socket.emit('bind-user', {userid: localStorage.userid, dialogid: localStorage.dialogid});
//             socket.on('msg-send', this.msgReceived);
//             socket.on('connect', function () {
//                 socket.emit('bind-user', {userid: localStorage.userid, dialogid: localStorage.dialogid});
//             });
//             // window.addEventListener("beforeunload", function (e) {
//             //     socket.emit('disconnect', {userid: localStorage.userid, dialogid: localStorage.dialogid});
//             // });
//             socket.on('disconnect', function () {
//                 console.log('disconnected');
//             });
//             this.eventHandler();
//         },


//         eventHandler: function () {
//             console.log('handler binded');
//             $('#fastChat').click(function (e) {
//                 e.preventDefault();
//                 fastChat();
//                 var msg = $('#message').val();
//                 if (msg == '') return;
//                 socket.emit('message', {
//                     userid: localStorage.userid,
//                     dialogid: localStorage.dialogid,
//                     message: msg
//                 });
//                 $('#message').val('');
//                 return false;
//             });
//             $('#message').keydown(function (e) {
//                 if (e.which == 13) {
//                     e.preventDefault();
//                     fastChat();
//                     var msg = $('#message').val();
//                     if (msg == '') return;
//                     socket.emit('message', {
//                         userid: localStorage.userid,
//                         dialogid: localStorage.dialogid,
//                         message: msg
//                     });
//                     $('#message').val('');
//                     return false;
//                 }
//             });
//         },

//         msgReceived: function (data) {
//             console.log(data);
//             $('#message_box').append(data.message);
//             _scrollBottom();
//         }
//     };
//     var socket = io.connect('https://rtcmulticonnection.herokuapp.com:443/');
//     chat.init(socket);


// }(jQuery));