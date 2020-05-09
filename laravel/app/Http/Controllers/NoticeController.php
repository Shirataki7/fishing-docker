<?php

namespace App\Http\Controllers;

use App\Consts\NoticeConst;
use Illuminate\Http\Request;
use App\Models\NoticeFriendAction;
use App\Models\NoticePostAction;
use Illuminate\Support\Facades\Auth;


class NoticeController extends Controller
{
    public function notices()
    {

        $comment_notices = NoticePostAction::where('user_id', Auth::id())->where('state', NoticeConst::UNREAD)->get();
        $friend_notices = NoticeFriendAction::where('user_id', Auth::id())->where('state', NoticeConst::UNREAD)->get();

        return view('notice', ['comments' => $comment_notices, 'friends' => $friend_notices]);
    }

    public function comment_notice_read($id)
    {
        $notice = NoticePostAction::find($id);
        $notice->state = NoticeConst::READ;
        $notice->update();
        $fish_record_id = $notice->fish_record_id;
        return redirect()->route('detalis', $fish_record_id);
    }

    public function friend_notice_read($id)
    {
        $notice = NoticeFriendAction::find($id);
        $notice->state = NoticeConst::READ;
        $notice->update();
        $added_friend_id = $notice->added_friend_id;
        return redirect()->route('friend_profile', $added_friend_id);
    }
}
