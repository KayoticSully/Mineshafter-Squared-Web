var chat;
var id;
$(document).ready(init);


function init() {
 chat = io.connect('http://server.mineshaftersquared.com:8000');
 id = $('#userid').val();
 
 chat.on('message', function(message){
    $('#chat').append('<div class="note">' + message + '</div>');
    var height = $('#chat')[0].scrollHeight;
    $('#chat').scrollTop(height);
 });
 
 $('#message').bind('keyup', function(event){
    var key = event.keyCode ? event.keyCode : event.which;
    
    if(key == 13 && !event.shiftKey) {
        post();
    }
 });
}

function post() {
    var message = $('#message').val();
    if(message != '') {
        $('#message').val('');
        chat.emit('post', { id: id, message: message});
    }
}
