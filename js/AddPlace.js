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
    });

    $('#add-place').submit(function(event) {
        event.preventDefault();

        if(validate($(this))) {
            var data = $(this).serialize() + "&altitude=" + altitude + "&longtitude=" + longtitude;
            $(this).trigger('reset');
            $.ajax({
                url: 'place/add',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log([data]);
                    putMarkers([data]);
                    autoScrollTop();
                }
            })
        }
    });
});

var validate = function(target)
{
    var errorMessage = '<div class="error-input"> {0} </div>';
    var inputs = target.children(':input:not(:button)');
    var errors = [
        'Не введена назва місця',
        'Не вірна адреса',
        'Не вибрана категорія',
        'Не заповнена інформація',
        'Клікніть по карті'
    ];

    var isValid = true;

    console.log(inputs);

    $.each(inputs, function(i) {
        if ($(this).val() == '') {
            console.log(errorMessage.replace('{0}', errors[i]));
            if(!$(this).next().is('div'))
                $(this).after(errorMessage.replace('{0}', errors[i]));
            isValid = false;
        }
        else if($(this).next().is('div'))
            $(this).next().remove();
    });

    if (altitude == undefined || longtitude == undefined) {
        isValid = false;
        target.children(':button').before(errorMessage.replace('{0}', errors[errors.length - 1]));
    }

    return isValid;
}

function autoScroll(){
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
}

function autoScrollTop(){
    $("html, body").animate({ scrollTop: 0 }, 1000);
}