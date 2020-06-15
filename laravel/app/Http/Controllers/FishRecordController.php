<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Consts\NoticeConst;
use App\Models\FishRecord;
use App\Http\Requests\CommentRequest;
use Request;
use App\Http\Requests\FishRecordRequest;
use App\Models\NoticePostAction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Facades\NoticeService;
use App\Models\TwitterAccount;

class FishRecordController extends Controller
{
    public function create(FishRecordRequest $request)
    {

        //入力された値をFishRecordsにいれる
        $fish_records = new FishRecord;
        $fish_records->user_id = Auth::id();
        $fish_records->fishing_date = $request->fishing_date;
        $fish_records->harbor = $request->harbor;
        $fish_records->ship = $request->ship;
        $fish_records->fish_name = $request->fish_name;
        $fish_records->size = $request->size;
        $fish_records->other_fish = $request->other_fish;
        $fish_records->weather = $request->weather;
        $fish_records->temperature = $request->temperature;
        $fish_records->depth = $request->depth;
        $fish_records->tool = $request->tool;
        $fish_records->tackle = $request->tackle;

        if ($request->fish_image == NULL) {
            $fish_records->fish_image = NULL;
        } else {
            $file = $request->file('fish_image');
            $path = Storage::disk('s3')->putFile('/fish_images', $file, 'public');
            $fish_records->fish_image = $path;
        }

        $fish_records->memo = $request->memo;

        $fish_records->save();

        return redirect()->action('FishRecordController@index');
    }
    public function index()
    {   //データベースの中身を取得

        $data =  FishRecord::where('user_id', Auth::id());

        // 検索       
        if (Request::query()) {
            //釣行日で絞り込み
            $search = Request::get('fishing_date');
            if (!empty($search)) {
                $data = FishRecord::whereDate('fishing_date', $search)->where('user_id', Auth::id());
            }
            //釣行先で絞り込み
            $search = Request::get('harbor');
            if (!empty($search)) {
                $data = FishRecord::where('harbor', $search)->where('user_id', Auth::id());
            }
            //船宿で絞り込み
            $search = Request::get('ship');
            if (!empty($search)) {
                $data = FishRecord::where('ship', $search)->where('user_id', Auth::id());
            }
            //釣った魚で絞り込み
            $search = Request::get('fish_name');
            if (!empty($search)) {
                $data = FishRecord::where('fish_name', $search)->where('user_id', Auth::id());
            }
            $data = $data->get();
            foreach ($data as $datum) {
                if ($datum->fish_image != NULL) {
                    $datum->fish_image = Storage::disk('s3')->url($datum->fish_image);
                }
            }
            return view('fish_record_search')->with('data', $data);
        }
        $data = $data->get();
        foreach ($data as $datum) {
            if ($datum->fish_image != NULL) {
                $datum->fish_image = Storage::disk('s3')->url($datum->fish_image);
            }
        }
        return view('fish_record_list', ['data' => $data]);
    }

    public function edit(Request $request, $id)
    {
        $rec = FishRecord::find($id);
        if ($rec->fish_image != NULL) {
            $rec->fish_image = Storage::disk('s3')->url($rec->fish_image);
        }
        return view('fish_record_edit', ['rec' => $rec]);
    }
    public function update(FishRecordRequest $request)
    {

        $fish_records = FishRecord::find($request->id);
        $fish_records->fishing_date = $request->fishing_date;
        $fish_records->harbor = $request->harbor;
        $fish_records->ship = $request->ship;
        $fish_records->fish_name = $request->fish_name;
        $fish_records->size = $request->size;
        $fish_records->other_fish = $request->other_fish;
        $fish_records->weather = $request->weather;
        $fish_records->temperature = $request->temperature;
        $fish_records->depth = $request->depth;
        $fish_records->tool = $request->tool;
        $fish_records->tackle = $request->tackle;

        if ($request->fish_image != NULL) {
            $file = $request->file('fish_image');
            $path = Storage::disk('s3')->putFile('/fish_images', $file, 'public');
            $fish_records->fish_image = $path;
        }

        $fish_records->memo = $request->memo;

        $fish_records->update();
        return redirect()->to('fish_records');
    }

    public function delete(Request $request, $id)
    {
        $rec = FishRecord::find($id);
        $rec->delete();
        return redirect()->to('fish_records');
    }

    public function detalis($id)
    {
        $rec = FishRecord::find($id);
        if ($rec->fish_image != NULL) {
            $rec->fish_image = Storage::disk('s3')->url($rec->fish_image);
        }
        return view('fish_record_detalis', ['rec' => $rec]);
    }

    public function comment(CommentRequest $request)
    {
        if (Auth::check()) {
            $comment = new Comment;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->fish_record_id = $request->fish_record_id;
            $comment->save();

            //コメント通知           
            $fish_record = FishRecord::find($request->fish_record_id);
            $user_id = $fish_record->user_id;
            if ($comment->user_id != $user_id) {
                NoticeService::new_notice_post_action($comment->fish_record_id, $user_id);
            }
            return redirect()->route('detalis', $request->fish_record_id);
        } else {
            session()->flash('flash_message', '投稿に失敗しました。ログインしてください。');
            return redirect()->route('detalis', $request->fish_record_id);
        }
    }

    public function comment_edit(Request $request, $id)
    {
        $comment = Comment::find($id);
        return view('comment_edit', ['comment' => $comment]);
    }
    public function comment_update(CommentRequest $request)
    {
        $comment = Comment::find($request->id);
        $comment->comment = $request->comment;
        $comment->update();
        return redirect()->route('detalis', $comment->fish_record_id);
    }
    public function comment_delete(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
