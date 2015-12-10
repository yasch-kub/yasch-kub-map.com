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

    registrationAndLoginEventListener();

    $('#registration-form').submit(function(event) {
        event.preventDefault();
        sendFormData('/user/registration', $(this));
    });

    $('#login-form').submit(function() {
        event.preventDefault();
        sendFormData('/user/login', $(this));
    });
    $('body').on('click','.logout-button',function(event){
        event.preventDefault();
        $.post('/logout', null, function(data){
            $('.is-login').after('<li id="to-registration-button"><a href="#"><span class="glyphicon glyphicon-user"></span> Реєстрація</a></li><li id="to-login-button"><a href="#"><span class="glyphicon glyphicon-log-in"></span> Вхід</a></li>');
            $('.is-login').remove();
            $('.logout-button').remove();
            registrationAndLoginEventListener();
        });
    });
});

function sendFormData(url, form) {
    var inputs = form.children(':input:not(:button)');
    $.post(url, form.serialize(), function(data) {
        console.log(data);
        console.log(url);
        if(data.answer == "OK") {
            $('.nav.navbar-nav.navbar-right').prepend('<li class="is-login"><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>')
            $('.is-login a').append(data.loginvalue);
            $('.is-login').after('<li class="logout-button"><a href="#"><span class="glyphicon glyphicon-log-out"></span> Вихід</a></li>');
            $('#to-login-button').remove();
            $('#to-registration-button').remove();
        }
        console.log(data.loginvalue);
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
    form.trigger('reset');
}

function registrationAndLoginEventListener(){
    $('#to-registration-button, #login-form a').click(function() {
        if($('#login-form').css('display') != 'none')
            $('#login-form').fadeOut(400, function() {
                $('#registration-form').showOrHideElement();
            });
        else
            $('#registration-form').showOrHideElement();
    });

    $('#to-login-button, #registration-form a').click(function() {
        if($('#registration-form').css('display') != 'none')
            $('#registration-form').fadeOut(400, function() {
                $('#login-form').showOrHideElement();
            });
        else
            $('#login-form').showOrHideElement()
    });
}

