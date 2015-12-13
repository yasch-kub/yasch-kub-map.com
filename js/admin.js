$(document).ready(function() {
    $('.admin-add-place-button').click(function(event) {
        event.preventDefault();
        var id = $(this).parent('td').children(':input[type=hidden]').val();
        var tr = $(this).parent('td').parent('tr');

        $.post('admin/add/' + id, function(data) {
            console.log(tr);
            if (data.status == 'OK')
                tr.fadeOut(400, function() {
                    remove();
                });
            else
                alert(data.message);
        }, 'json');
    });

    $('.admin-remove-place-button').click(function(event) {
        event.preventDefault();
        var id = $(this).parent('td').children(':input[type=hidden]').val();
        var tr = $(this).parent('td').parent('tr');

        $.post('admin/remove/' + id, function(data) {
            console.log(tr);
            if (data.status == 'OK')
                tr.remove();
            else
                alert(data.message);
        }, 'json');
    });
});