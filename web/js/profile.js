console.log('profile.js start');



    checkNewMessages();

    setInterval(function(){
        checkNewMessages();
    }, 3000);

    var disableButton = false;

    function checkNewMessages() {

        $.ajax({
            url: "/messages/ajax-count-new-message",
            success: function(result) {

                var countNewMessages = parseInt(JSON.parse(result));
                $('#refreshButton').click();

                console.log(countNewMessages,parseInt(JSON.parse(result)));
                $('#count-new-messages').html(countNewMessages);
            }
        });
        if(!disableButton) {
            //$('#refreshButton').click();
        }
    }

console.log('profile.js finish');