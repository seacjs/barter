//$(document).ready(function(){
    var conn = new WebSocket('ws://barter:8080');
    conn.onmessage = function(e) {
        console.log('Response:' + e.data);
    };
    conn.onopen = function(e) {
        console.log("Connection established!");
        console.log('Hey!');
        conn.send('Hey!');
    };
//});

/**
 *
 * три файла для работы с сокетами:
 * 1. на любой странице запрашивает дилаги, вот этого может не быть, пока не понятно.
 * 2. на странице диалогов.
 * 3. на странице с диалогом, там где сообщения.
 *
 * */

//socket.send("Привет");
//socket.onopen = function() {
//    alert("Соединение установлено.");
//};
//
//socket.onclose = function(event){
//    if (event.wasClean) {
//        alert('Соединение закрыто чисто');
//    } else {
//        alert('Обрыв соединения'); // например, "убит" процесс сервера
//    }
//    alert('Код: ' + event.code + ' причина: ' + event.reason);
//};
//
//socket.onmessage = function(event){
//    alert("Получены данные " + event.data);
//};
//
//socket.onerror = function(error){
//    alert("Ошибка " + error.message);
//};