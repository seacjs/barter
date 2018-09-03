/**
 *
 * три файла для работы с сокетами:
 * 1. на любой странице запрашивает дилаги, вот этого может не быть, пока не понятно.
 * 2. на странице диалогов.
 * 3. на странице с диалогом, там где сообщения.
 *
 * */
//$(function() {
    console.log('chat server start');

    //var chat = new WebSocket('ws://barter.tmweb.ru:8080');
    //var chat = new WebSocket('ws://barter:8080');

    var messagesList = document.getElementById("chat");
    messagesList.scrollTop = messagesList.scrollHeight;



    var websocketServerLocation = 'ws://barter.tmweb.ru:8080';
    var chat;

    function startSocket(websocketServerLocation){

        chat = new WebSocket(websocketServerLocation);

        chat.onmessage = function(e) {
            $('#response').text('');

            var response = JSON.parse(e.data);

            if(response.type && response.type == 'onReady') {
                $('#message').css({'display': 'block'});
            }

            if (response.type && response.type == 'chat') {
                $('#chat').append(response.message);
                $('#chat').scrollTop = $('#chat').height;
            } else if (response.message) {
                $('#response').text(response.message);
            }
            var messagesList = document.getElementById("chat");
            messagesList.scrollTop = messagesList.scrollHeight;
            console.log(response.message);
        };

        chat.onopen = function(e) {
            chat.send( JSON.stringify({'action' : 'setUser', 'name' : $('#user_from').val() }) );
            //chat.send( JSON.stringify({'action' : 'setName', 'name' : $('#user_from').val() }) );
            chat.send(JSON.stringify({'action' : 'onReady'}));
            //chat.send( JSON.stringify({'action' : 'message', 'to': 1, 'message' : 'Connection established!' }));
        };

        chat.onclose = function(){
            // Try to reconnect in 5 seconds
            setTimeout(function(){startSocket(websocketServerLocation)}, 1000);
        };

        $("#message").keydown(function(e) {
            if(e.keyCode==13) {
                if ($('#message').val()) {

                    if(!chat || chat.readyState == 3) {
                        console.log(chat,'reStart socket');
                        startSocket(websocketServerLocation);
                    } else {
                        chat.send(JSON.stringify({
                            'action': 'message',
                            'message': $('#message').val(),
                            'to': $('#user_to').val(),
                        }));
                    }
                    $('#message').val('');
                    $('#message').focus();

                    var messagesList = document.getElementById("chat");
                    messagesList.scrollTop = messagesList.scrollHeight;
                }

            }
        });


    }

    startSocket(websocketServerLocation);




    $("#message").keyup(function(e) {
        if(e.keyCode==13) {
            $('#message').val('');
            $('#message').focus();

            var messagesList = document.getElementById("chat");
            messagesList.scrollTop = messagesList.scrollHeight;
        }
    });

    //$('#btnSend').click(function() {
    //    if ($('#message').val()) {
    //        chat.send(JSON.stringify({
    //            'action': 'message',
    //            'message': $('#message').val(),
    //            'to': $('#user_to').val(),
    //        }));
    //        $('#message').val('');
    //        $('#message').focus();
    //    }
    //});


//});


