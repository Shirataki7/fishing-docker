<?php

namespace App\Http\Controllers;

use App\Consts\NoticeConst;
use App\Models\FishRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Friend;
use App\Http\Requests\FriendRequest;
use  App\Facades\NoticeService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function top()
    {
        if (Auth::check()) {
            $id = Auth::id();
            $user = User::find($id);
            $friend_records = Friend::all();
            $friend_ids = Friend::where('user_id', Auth::id())->pluck('friend_id');
            if ($friend_ids) {
                $friend_records = FishRecord::whereIn('user_id', $friend_ids)->orderBy('created_at', 'desc')->take(5)->get();
                foreach ($friend_records as $record) {
                    if ($record->fish_image != NULL) {
                        $record->fish_image = Storage::disk('s3')->url($record->fish_image);
                    }
                }
                return view('user_top', ['user' => $user, 'friend_records' => $friend_records]);
            } else {
                return view('user_top', ['user' => $user]);
            }
        } else {
            return redirect()->route('top');
        }
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        if ($user->user_image != NULL) {
            $user->user_image = Storage::disk('s3')->url($user->user_image);
        }
        return view('user_edit', ['user' => $user]);
    }

    public function update(UserRequest $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;
        if ($request->user_image != NULL) {
            $file = $request->file('user_image');
            $path = Storage::disk('s3')->putFile('/user_images', $file, 'public');
            $user->user_image = $path;
        }
        $user->update();
        return redirect()->to('mypage');
    }

    public function friend(FriendRequest $request)
    {
        $search_name = $request->name;
        $friend_user = User::where('name', 'like', $search_name)->get();
        foreach ($friend_user as $user) {
            if ($user->user_image != NULL) {
                $user->user_image = Storage::disk('s3')->url($user->user_image);
            }
        }
        if (count($friend_user) > 0) {
            return view('friend_search', ['friend_user' => $friend_user]);
        } else {
            $friend_user = User::query()->orderBy('created_at', 'desc')->take(10)->get();
            foreach ($friend_user as $user) {
                if ($user->user_image != NULL) {
                    $user->user_image = Storage::disk('s3')->url($user->user_image);
                }
            }
            return view('friend_search', ['friend_user' => $friend_user]);
        }
    }

    public function add_friend(Request $request)
    {
        $friend = new Friend();
        $friend->user_id = Auth::id();
        $friend->friend_id = $request->friend_id;

        $added = Friend::where('user_id', Auth::id())->where('friend_id', $friend->friend_id)->get();
        if (Auth::id() == $friend->friend_id) {
            session()->flash('flash_message', 'フレンドになれませんでした。');
            return redirect()->route('search_friend');
        } elseif (count($added) > 0) {
            session()->flash('flash_message', 'フレンド追加済みです。');
            return redirect()->route('search_friend');
        } else {
            $friend->save();
            //フレンド追加の通知
            NoticeService::new_notice_friend_action($friend->friend_id, $friend->user_id);
            session()->flash('flash_message', 'フレンドになりました！');
            return redirect()->route('search_friend');
        }
    }

    public function index()
    {
        $friends = Friend::where('user_id', Auth::id())->get();
        return view('friend_list', ['friends' => $friends]);
    }

    public function friend_profile($id)
    {
        $user = User::find($id);
        $is_friend = Friend::where('user_id', Auth::id())->where('friend_id', $id)->exists();
        return view('friend_profile', ['user' => $user, 'is_friend' => $is_friend]);
    }

    public function friend_delete($id)
    {
        $friend = Friend::where('friend_id', $id)
            ->where('user_id', Auth::id());
        $friend->delete();
        return redirect()->route('friend_list');
    }
}
