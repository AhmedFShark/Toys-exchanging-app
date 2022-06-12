$('.edit').click(function(){
    var useid=$(this).attr('data-classid');
    $.post('../clinic/includes/users/modal_users.php', {
        userid: useid
    }, function (result) {
        $("#updateUserID").val(useid);
        $("#ecredential").val(result.credential);
        $("#eusername").val(result.u_username);
    }, 'json');
});

$('.view').click(function(){
    $.post('../clinic/includes/users/modal_users.php', {
        userid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vcredential").innerHTML = result.credential;
        document.getElementById("vusername").innerHTML = result.u_username;
    }, 'json'); 
});

$('.delete').click(function(){
    $("#deleteUserID").val($(this).attr('data-dclassid'));
});
