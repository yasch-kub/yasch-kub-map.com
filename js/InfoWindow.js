function AddRating(mark, id){
    $.ajax({
        url:'add_rating/'+ mark + '/' + id,
        type: 'post',
        success: function(data){
            console.log(data);
            if ($.isNumeric(data))
                UpdateRating(data);
            else
                alert(data);
        }
    });
}

function UpdateRating(data){
    $('.rating').children('span').each(function(i) {
        if (data >= 5 - i)
            $(this).html('<i class="fa fa-star"></i>');
        else if (data == 5 - i - 0.5)
            $(this).html('<i class="fa fa-star-half-o"></i>');
        else
            $(this).html('<i class="fa fa-star-o"></i>');
    });
}