console.log('profile.js start');

    checkNewMessages();

    setInterval(function(){
        checkNewMessages();
    }, 3000);

    function checkNewMessages() {
        var countNewMessages = 0;
        $.ajax({
            url: "/messages/ajax-count-new-message",
            success: function(result) {
                var countNewMessages = JSON.parse(result);
                console.log(parseInt(countNewMessages));
                $('#count-new-messages').html(countNewMessages);
            }
        });
    }

console.log('profile.js finish');