$(document).ready(function(){

    $(".message_send, .message_receive").click(function(){
        $(this).find('.hide').slideToggle();
    });

    $('.new_message').click(function(){
        $(this).removeClass('new_message');
        var id = $(this).attr('id');
        $.post( "/message/read", { message_id: id } , function( data ) {

        });
    });

    $('.reply').click(function(){
        var id = $(this).attr('id').split('_')[1];
        $('#form_' + id).slideToggle();
    });
});