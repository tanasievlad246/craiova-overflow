$(document).ready(function () {
    // Like button ajax
    $('.like-btn').on('click', function () {
        const answer_id = $(this).data('id');
        $clickedBtn = $('.like-btn');
        let action;

        if ($clickedBtn.hasClass('btn-main')) {
            action = 'like';
        } else if ($clickedBtn.hasClass('btn-success')) {
            action = 'unlike';
        }

        $.ajax({
            method: 'POST',
            url: './src/includes/rate.inc.php',
            data: {
                'action': action,
                'answer_id': answer_id
            }
        }).done(function (data) {
            let res = JSON.parse(data);
            console.log(res);
            if (action == 'like') {
                $clickedBtn.removeClass('btn-main');
                $clickedBtn.addClass('btn-success');
            } else if (action == 'unlike') {
                $clickedBtn.removeClass('btn-success');
                $clickedBtn.addClass('btn-main');
            }
        })
    })

    // dislike button ajax
    $('.dislike-btn').on('click', function () {
        const answer_id = $(this).data('id');
        $clickedBtn = $('.dislike-btn');
        let action;

        if ($clickedBtn.hasClass('btn-main')) {
            action = 'dislike';
        } else if ($clickedBtn.hasClass('btn-danger')) {
            action = 'unlike';
        }

        $.ajax({
            method: 'POST',
            url: './src/includes/rate.inc.php',
            data: {
                'action': action,
                'answer_id': answer_id
            }
        }).done(function (data) {
            let res = JSON.parse(data);
            console.log(res);
            if (action == 'dislike') {
                $clickedBtn.removeClass('btn-main');
                $clickedBtn.addClass('btn-danger');
            } else if (action == 'undislike') {
                $clickedBtn.removeClass('btn-danger');
                $clickedBtn.addClass('btn-main');
            }
        })
    })
})