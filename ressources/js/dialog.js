// Dialogue Jquery ui message
$( function() {
    $( "#dialog-message" ).dialog({
        modal: true,
        buttons: {
            Ok: function() {
            $( this ).dialog( "close" );
        }
    }
    });
});


