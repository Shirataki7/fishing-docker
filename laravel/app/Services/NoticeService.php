<?php

namespace App\Services;

use App\Models\NoticePostAction;
use App\Consts\NoticeConst;
use App\Models\NoticeFriendAction;


class NoticeService
{
    public function new_notice_post_action($fish_record_id,$user_id)
    {
        $notice = new NoticePostAction;
        $notice->user_id = $user_id;
        $notice->fish_record_id = $fish_record_id;
        $notice->state = NoticeConst::UNREAD;
        $notice->save();

        return $notice;
    }

    public function new_notice_friend_action($friend_id,$user_id)
    {
        $notice = new NoticeFriendAction;
        $notice->user_id = $friend_id;
        $notice->added_friend_id = $user_id;
        $notice->state = NoticeConst::UNREAD;
        $notice->save();

        return $notice;
    }
}
