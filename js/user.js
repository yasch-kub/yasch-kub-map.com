$.fn.showOrHideElement = function() {
    if(this.css('display') == 'none')
        this.fadeIn(400);
    else
        this.fadeOut(400);
    return this;
};

$(document).ready(function() {
    $('#data').on('submit', '.add-comment', function() {
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
});
