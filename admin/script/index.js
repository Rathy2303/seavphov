$(document).ready(function(){
    $("#checkbox").on('click',function(){
        let status = $(this).is(':checked');
        $.ajax({
            type: "POST",
            url: "./php/site_offline.php",
            data: {
                "status":status,
            },
   
            //if received a response from the server
            success: function(rp) {
            },

            //If there was no resonse from the server
            error: function(jqXHR, textStatus, errorThrown){

            },

            //capture the request before it was sent to server
            beforeSend: function(jqXHR, settings){

            },
        }); 

    })
})