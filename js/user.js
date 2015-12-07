$.fn.showOrHideElement = function() {
    if(this.css('display') == 'none')
        this.fadeIn(400);
    else
        this.fadeOut(400);
    return this;
};

$(document).ready(function() {
    $('#data').on('submit', '.add-comment', function(event) {
        event.preventDefault();
        $.post('/user/add_comment', $('.add-comment').serialize() + '&id=' + currentMarker.id,
            function(data) {
                $('.comment').append(data);
                $('textarea[name=comment]').val('');
            });
    });

    $('#add-place-button').click(function() {
        $('#add-place').showOrHideElement();
    });

    $('#to-registration-button').click(function() {
        if($('#login-form').css('display') != 'none')
            $('#login-form').fadeOut(400, function() {
                $('#registration-form').showOrHideElement();
            });
        else
            $('#registration-form').showOrHideElement();
    });

    $('#to-login-button').click(function() {
        if($('#registration-form').css('display') != 'none')
            $('#registration-form').fadeOut(400, function() {
                $('#login-form').showOrHideElement();
            });
        else
            $('#login-form').showOrHideElement()
    });

    $('#registration-form').submit(function(event) {
        event.preventDefault();
        sendFormData('/user/registration', $(this));
    });

    $('#login-form').submit(function() {
        event.preventDefault();
        sendFormData('/user/login', $(this));
    });
});

function sendFormData(url, form) {
    var inputs = form.children(':input:not(:button)');
    $.post(url, form.serialize(), function(data) {
        console.log(data);
        console.log(url);

        inputs.each(function() {
            var curAnswer = data[$(this).attr('name')];
            var next = $(this).next();

            if (curAnswer == 'OK' || !curAnswer)
            {
                if (next.is("div"))
                    next.remove();
            }
            else
            {
                if (next.is("div"))
                    $(this).next().remove();
                $(this).after("<div class = 'validation-error'>" + curAnswer + "</div>");
            }
        });
    }, 'json');
}
