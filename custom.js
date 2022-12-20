$(document).ready(function(){
    // alert('helo');
    $( '.add-btn').click(function(e){
        e.preventDefault();
        
        var comment = $('.comment_text').val();
        if($.trim(comment).length == 0)
            {
                err_msg = "Comment box is empty";
                $('#error_status').text(err_msg); 
            } else {
                err_msg = "";
                $('#error_status').text(err_msg);
            }

                var data = {
                    'msg' : comment,
                    'add_comm' : true,
                };
                $.ajax({
                    type: "POST",
                    url : "insertCom.php",
                    data: data, 
                    sucess: function (response){
                        alert(response)
                    }

                })
            }
    ,)
});
 