$(document).ready(function() {
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

    $('.nav-tabs a').click(function() {
        var url = $(this).attr('id') == 'admin-to-new-place' ? '/admin/new_place_table' : '/admin/all_place_table';
        $.post('/admin/n', 'sdfsdfsdf', function(data) {
            console.log(url);
            $('.tab-content').html(data);
        });
    });
});