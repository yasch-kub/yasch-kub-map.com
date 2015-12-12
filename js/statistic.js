$(document).ready(function() {
    $('#selected-item').on('input', function (){
        var val = this.value;
        if($('#filter_list').find('option').filter(function(){
                return this.value === val;
            }).length) {
            console.log($(this).val());
        }
    });
});