$(document).ready(function(){
    $.ajax({
        url:'place/categories',
        type: 'post',
        dataType:'json',
        success:function(data){
            data.forEach(function(index){
                $("#category_list").append('<option>' + index.name + '</option>');
            });
        }
    })
});