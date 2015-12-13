$(document).ready(function() {
    $('.tab-content').on('click', '.admin-add-place-button, .admin-remove-place-button', function(event) {
        event.preventDefault();
        var id = $(this).parent('td').children(':input[type=hidden]').val();
        var tr = $(this).parent('td').parent('tr');
        var url = $(this).attr('class').search('admin-add-place-button') != -1 ? 'admin/add/' : 'admin/remove/';

        $.post(url + id, function(data) {
            console.log(tr);
            if (data.status == 'OK')
                    tr.remove();
            else
                alert(data.message);
        }, 'json');
    });

    var tabs = {
        'admin-tab-1': 'admin/get_new_place_table',
        'admin-tab-2': 'admin/get_all_place_table'
    };

    $('.nav-tabs li').click(function(event) {
        event.preventDefault();
        var url = tabs[$(this).attr('id')];

        if ($(this).attr('class') != 'active') {
            console.log(url);
            $('.nav-tabs li').removeClass('active');
            $(this).addClass('active');
            $.post(url, function(data) {
                $('.tab-content').html(data);
            });
        }
    });
});