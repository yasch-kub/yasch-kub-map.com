$(document).ready(function() {
    //$('#selected-item').on('input', function (){
    //    var val = this.value;
    //    if($('#filter_list').find('option').filter(function(){
    //            return this.value === val;
    //        }).length) {
    //        $.post();
    //    }
    //});
    $('#selected-item').change(function (){
        $.post('/statistic/get_table', $(this).val() == 'Всі...' ? '' : $(this).val(), function(data) {
            $('#content').fadeOut(300, function() {
                $('#content').html(data);
            });
            $('#content').fadeIn(300);
        });
    });

    $('th').click(function() {
        var el = $(this).children('span');
        var html = el.html();

        $('th span').html('');
        el.html(html);

        var type;

        switch(el.html()) {
            case '': el.html('<i class="fa fa-long-arrow-down"></i>'); type = 'ASC'; break;
            case '<i class="fa fa-long-arrow-up"></i>': el.html('<i class="fa fa-long-arrow-down"></i>'); type = 'DESC'; break;
            case '<i class="fa fa-long-arrow-down"></i>': el.html('<i class="fa fa-long-arrow-up"></i>'); type = 'DESC'; break;
        }
    });
});