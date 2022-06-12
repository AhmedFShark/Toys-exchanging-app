$('.edit').click(function(){
    var tyid=$(this).attr('data-classid');
    $.post('../Masters/includes/toys/modal_toys.php', {
        toyid: tyid
    }, function (result) {
        $("#updateToyID").val(tyid);
        $("#edes").val(result.des);
        document.getElementById('evphoto').src = result.photo;
        document.getElementById('ephoto').src = result.photo;
    }, 'json');
});

$('.view').click(function(){
    $.post('../Masters/includes/toys/modal_toys.php', {
        toyid: $(this).attr('data-vclassid')
    }, function (result) {
        document.getElementById("vowner").innerHTML = result.owner;
        document.getElementById("vdes").innerHTML = result.des;
        document.getElementById('vphoto').src = result.photo;
    }, 'json');
});

$('.delete').click(function(){
    $("#deleteToyID").val($(this).attr('data-dclassid'));
});

function isEmpty(column){
    if(column == '')
        return '<i class="fa fa-close font-red-thunderbird font-lg"></i>';
    else
        return column;
}
