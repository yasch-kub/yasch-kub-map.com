$(document).ready(function() {

    var fields = {
        'Місце': 'name',
        'Адреса': 'address',
        'Рейтинг': 'mark' ,
        'К-сть голосів': 'n_views',
        'К-сть коментарів': 'n_comments'
    };

    var type;
    var field;

    $('#selected-item').change(function (){

        var options = {
            'category': $(this).val() == 'Всі...' ? '' : $(this).val(),
            'field': field,
            'order': type == 'ASC' ? true : false
        }

        $.post('/statistic/get_table', JSON.stringify(options), function(data) {
            $('#content').fadeOut(300, function() {
                $('#content tbody').html(data);
            });
            $('#content').fadeIn(300);
        });
    });

    $('#content').on('click', 'th' , function() {
        var el = $(this).children('span');
        var html = el.html();

        $('th span').html('');
        el.html(html);

        switch(el.html()) {
            case '': el.html('<i class="fa fa-long-arrow-down"></i>'); type = 'ASC'; break;
            case '<i class="fa fa-long-arrow-up"></i>': el.html('<i class="fa fa-long-arrow-down"></i>'); type = 'ASC'; break;
            case '<i class="fa fa-long-arrow-down"></i>': el.html('<i class="fa fa-long-arrow-up"></i>'); type = 'DESC'; break;
        }

        field = fields[$(this).text()];
        var options = {
            'category': $('#selected-item').val() == 'Всі...' ? '' : $('#selected-item').val(),
            'field': field,
            'order': type == 'ASC' ? true : false
        }

        console.log(options);

        $.post('statistic/get_table', JSON.stringify(options), function(data) {
            $('#content tbody').fadeOut(300, function() {
                $(this).html(data);
            });
            $('#content tbody').fadeIn(300);
        });
    });
});