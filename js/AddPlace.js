$(document).ready(function(){
    $.ajax({
        url:'place/categories',
        type: 'post',
        dataType:'json',
        success:function(data){
            $.each(data, function(index, value){
                $("#category_list").append('<option>' + value.name + '</option>');
            });
        }
    })
});