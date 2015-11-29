$(document).ready(function(){
    $.ajax({
        url: 'place/categories',
        type: 'post',
        dataType: 'json',
        success: function(data){
            $.each(data, function(index, value){
                $("#category_list").append('<option>' + value.name + '</option>');
            });
        }
    })
    $('#add-place').submit(function(event) {
        event.preventDefault();
        var data = $(this).serialize() + "&altitude=" + altitude +  "&longtitude=" + longtitude;
        $.ajax({
            url: 'place/add',
            type: 'post',
            data: data,
            success: function(data){
                console.log(data);
            }
        })
    });
});