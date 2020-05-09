$(function () {
    $('.add_comment').click(function () {
        if (confirm('コメントを投稿します！')) {
        } else {
            return false;
        }
    });
});

$(function () {
    $('.comment_delete').click(function () {
        if (confirm('本当に削除しますか？')) {
        } else {
            return false;
        }
    });
});