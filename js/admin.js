$(document).ready(function() {
    //$('.admin-add-place-button').click(function(event) {
    //    event.preventDefault();
    //    var id = $(this).parent('td').children(':input[type=hidden]').val();
    //    var tr = $(this).parent('td').parent('tr');
    //
    //    $.post('admin/add/' + id, function(data) {
    //        console.log(tr);
    //        if (data.status == 'OK')
    //            tr.remove();
    //        else
    //            alert(data.message);
    //    }, 'json');
    //});
    //
    //$('.admin-remove-place-button').click(function(event) {
    //    event.preventDefault();
    //    var id = $(this).parent('td').children(':input[type=hidden]').val();
    //    var tr = $(this).parent('td').parent('tr');
    //
    //    $.post('admin/remove/' + id, function(data) {
    //        console.log(tr);
    //        if (data.status == 'OK')
    //            tr.remove();
    //        else
    //            alert(data.message);
    //    }, 'json');
    //});
    $('.admin-add-place-button, .admin-remove-place-button').click(function(event) {
        event.preventDefault();
        var id = $(this).parent('td').children(':input[type=hidden]').val();
        var tr = $(this).parent('td').parent('tr');
        var url = $(this).attr('class').search('admin-add-place-button') != -1 ? 'admin/add/' : 'admin/remove/';

        $.post('admin/add/' + id, function(data) {
            console.log(tr);
            if (data.status == 'OK')
                    tr.remove();
            else
                alert(data.message);
        }, 'json');
    });
});