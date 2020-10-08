$(document).ready(function () {
    let rating = $('.rating');
    // Like button ajax
    $('.like-btn').on('click', function () {
        const answer_id = $(this).data('id');
        $clickedBtn = $(this);
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
            res = JSON.parse(data);
            console.log(res)
            if (action === 'like') {
                $clickedBtn.removeClass('btn-main');
                $clickedBtn.addClass('btn-success');
                $clickedBtn.siblings().removeClass('btn-danger');
                $clickedBtn.siblings().addClass('btn-main');
                rating.html(res.rating);
            } else if (action === 'unlike') {
                $clickedBtn.removeClass('btn-success');
                $clickedBtn.addClass('btn-main');
                rating.html(res.rating);
            }
        })
    })

    // dislike button ajax
    $('.dislike-btn').on('click', function () {
        const answer_id = $(this).data('id');
        $clickedBtn = $(this);
        let action;

        if ($clickedBtn.hasClass('btn-main')) {
            action = 'dislike';
        } else if ($clickedBtn.hasClass('btn-danger')) {
            action = 'undislike';
        }

        $.ajax({
            method: 'POST',
            url: './src/includes/rate.inc.php',
            data: {
                'action': action,
                'answer_id': answer_id
            }
        }).done(function (data) {
            res = JSON.parse(data);
            if (action === 'dislike') {
                $clickedBtn.removeClass('btn-main');
                $clickedBtn.addClass('btn-danger');
                $clickedBtn.siblings().removeClass('btn-success');
                $clickedBtn.siblings().addClass('btn-main');
                rating.html(res.rating);
            } else if (action === 'undislike') {
                $clickedBtn.removeClass('btn-danger');
                $clickedBtn.addClass('btn-main');
                rating.html(res.rating);
            }

        })
    })
})
