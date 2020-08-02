// AJAX Contact
$(function(){
    var form = $("#contact");
    var formMessages = $("#form-messages");

    // Event listener for submit
    $(form).submit(function(event){
        event.preventDefault();

        var formData = $(form).serialize();

        // Submit the form
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
        }).done(function(response){
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text
            $(formMessages).text(response);
            //alert(response);

            // Clear the form
            $("#email").val('');
            $("#first-name").val('');
            $("#last-name").val('');
            $("#phone").val('');
            $("#organisation").val('');
            $("#message").val('');
        }).fail(function(data){
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            if(data.responseText !== ''){
                //$(formMessages).text(data.responseText);
                alert("Message was sent successfully");
            }else{
                //$(formMessages).text('An error occurred and your message could not be sent.');
                alert('An error occurred and your message could not be sent.');
            }
        });
    });
});
