$(function () {
    $(document).on('click', '.subscription-btn', function () {
        let $btn = $(this);
        $('#phone').val('');
        $('#subscribe-btn').data('id', $btn.data('id'));
        $('.subscription-modal').modal('show');
    });

    $(document).on('click', '#subscribe-btn', function () {
        let $btn = $(this);
        $.ajax({
            url: '/author/subscribe',
            method: 'post',
            data: {
                id: $btn.data('id'),
                phone: $('#phone').val(),
            },
            statusCode: {
                200: function () {
                    alert('Subscription successful');
                },
                409: function () {
                    alert('You have already subscribed to this author');
                },
                500: function () {
                    alert('Oops... Something went wrong');
                }
            }
        });
    });
});