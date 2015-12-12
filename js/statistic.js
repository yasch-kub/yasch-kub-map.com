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
        $.post('/statistic/get_table', $(this).val(), function(data) {
            $('#content').fadeOut(300, function() {
                $('#content').html(data);
            });
            $('#content').fadeIn(300);
        });
    });
});