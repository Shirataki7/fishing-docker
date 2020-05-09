
jQuery(function ($) {
    $('.detalis').addClass('clickable').click(function () {
        window.location = $(this).attr('data-href');
    }).find('a').hover(function () {
        $(this).parents('tr').unbind('click');
    }, function () {
        $(this).parents('tr').click(function () {
            window.location = $(this).attr('data-href');
        });
    });
});

$(function() {
    $('.rec_inner').hover(function() {
      $(this).css('background', '#e0efff');
    }, function() {
      $(this).css('background', '');
    });
  });

$(function () {
    $('.delete').click(function () {
        if (confirm('本当に削除しますか？')) {
        } else {
            return false;
        }
    });
});


