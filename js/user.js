$.fn.showOrHideElement = function() {
    if(this.css('display') == 'none') {
        this.fadeIn(400);
        autoScroll();
    }
    else {
        this.fadeOut(400);
        autoScrollTop();
    }
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

    $('body').on('click', '#add-place-button', function() {
            $('#control-panel form:not(form[id=add-place])').css('display', 'none');
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
    $('body').on('click', '.logout-button',function(event){
        event.preventDefault();
        $.post('/logout', null, function(data){
            $('header').html(data.header);
            $('#control-panel form').fadeOut(400);
        }, 'json');
    });
});

function sendFormData(url, form) {
    var inputs = form.children(':input:not(:button)');
    $.post(url, form.serialize(), function(data) {
        console.log(data);
        console.log(url);
        if(data.answer == "OK") {
            $('header').html(data.header);
            autoScrollTop();
            form.fadeOut(400);
            
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
    $('body').on('click', '#to-registration-button, #login-form a', function() {
        $('#control-panel form:not(form[id=registration-form])').css('display', 'none');
        $('#registration-form').showOrHideElement();
    });

    $('body').on('click', '#to-login-button, #registration-form a', function() {
        $('#control-panel form:not(form[id=login-form])').css('display', 'none');
        $('#login-form').showOrHideElement();
    });
}

