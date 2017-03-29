$(document).ready(function () {
    $('#logout').on('click', function () {
        $('#logout-form').submit();
    });
});

$(document).on('keyup', '#searchMember', function(){
    var url = '/search/member';
    var name = $(this).val();
    var content = $('#content');

    $.get(url, { name: name }, function (data) {
        content.html(data);
    });
});

$('.multi-item-carousel').carousel({
    interval: false
});

$('.multi-item-carousel .item').each(function (){
    var next = $(this).next();

    if (!next.length) {
        next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));

    if (next.next().length > 0) {
        next.next().children(':first-child').clone().appendTo($(this));
    } else {
        $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
    }
});

$(document).on('click', '.comment', function () {
    $(this).closest('p.action').siblings('.content').removeClass('hidden');
});

$(document).on('click', '#full-video', function () {
    var url = '/video/full';
    var content = $('#review_content');

    $.get(url, function (data) {
        content.html(data);
    });
});

$(document).on('click', '.review-category', function () {
    var url = '/category/review';
    var categoryId = $(this).children('.categoryId').val();

    $.get(url, { categoryId: categoryId }, function (data) {
        $('#review_content').html(data);
    });
});

$(document).on('keyup', '#searchReview', function (){
    var url = '/search/review';
    var key = $(this).val();

    $.get(url, { caption: key }, function (data) {
        $('#review_content').html(data);
    });
});

$(document).on('keypress', '.enter_comment', function(e) {
    var _token = $('.token-comment').val()
    var commentContent = $(this).val();
    var actionItem = $(this).closest('.action-item');
    var content = $(this).closest('.content');
    var reviewId = content.siblings('.action').find('.reviewId').val();
    var url = '/user/comment';

    if (e.which == 13) {
        $.post(url, { commentContent: commentContent, reviewId: reviewId, _token: _token }, function (data) {
            actionItem.html(data);
        });
    }
});

$(document).on('click', '.btn-like', function () {
    var url = '/user/like';
    var action = $(this).closest('.action-item').find('.action');
    var reviewId = $(this).closest('.action-item').find('.reviewId').val();

    $.get(url, {reviewId: reviewId}, function (data) {
        action.html(data);
    });
});

$(document).on('click', '.btn-unlike', function () {
    var url = '/user/unLike';
    var action = $(this).closest('.action-item').find('.action');
    var reviewId = $(this).closest('.action-item').find('.reviewId').val();

    $.get(url, {reviewId: reviewId}, function (data) {
        action.html(data);
    });
});

$(document).on('mouseenter', '.old_comment', function () {
    var hidden = $(this).children('.material-icons').removeClass('hidden');
});

$(document).on('mouseleave', '.old_comment', function () {
    var hidden = $(this).children('.material-icons').addClass('hidden');
});

$(document).on('click', '.del', function () {
    var content = $(this).closest('.action-item');
    var reviewId = content.find('.reviewId').val();
    var commentId = $(this).siblings('.commentId').val();
    var url = '/user/comment/' + commentId;
    var _token = $('.token-action').val();

    $.ajax({
        url: url,
        data: {
                _token: _token,
            },
        type: 'DELETE',
        success: function(data) {
            content.html(data);
        }
    });
});

$(document).on('click', '.edit', function () {
    var comment = $(this).closest('.old_comment').find('.edit_comment');
    comment.removeClass('hidden');
    comment.siblings('span').addClass('hidden');
});

$(document).on('keypress', '.edit_comment', function (e) {
    var commentEdit = $(this);
    var content = commentEdit.val();
    var commentId = commentEdit.closest('.old_comment').find('.commentId').val();
    var actionItem = commentEdit.closest('.action-item');
    var url = '/user/comment/' + commentId;

    if (e.which == 13) {
        $.get(url, { content: content }, function () {
            $.ajax({
                url: url,
                data: {
                        _token: _token,
                    },
                type: 'PUT',
                success: function(data) {
                    actionItem.html(data);
                }
            });
        });

        commentEdit.addClass('hidden');
        commentEdit.siblings('span').removeClass('hidden');
    }
});
