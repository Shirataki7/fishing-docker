<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//LaravelのTOPページ

use App\Models\Fish_Record;

//portfolio TOPページ
Auth::routes();
Route::get('/','TopController@index')->name('top');

//portfolio 釣り記録登録表示用のページ
Route::get('fish_records/new',function(){
    return view('fishrecord');
})->name('new');

//釣り記録登録ボタンを押した時の処理
Route::post('fish_records','FishRecordController@create');

//釣り記録一覧ページ
Route::get('fish_records','FishRecordController@index')->name('list');

//釣り記録編集ページ
Route::post('fish_records/edit/{id}','FishRecordController@edit')->name('edit');

//釣り記録編集投稿
Route::post('fish_records/update/{id}','FishRecordController@update')->name('update');

//釣り記録削除
Route::delete('fish_records/delete/{id}','FishRecordController@delete')->name('delete');

//釣り記録詳細ページ
Route::get('fish_records/{id}','FishRecordController@detalis')->name('detalis');

//釣り記録詳細ページのコメント
Route::post('fish_records/{id}/comments','FishRecordController@comment')->name('comment');

//コメントの編集ページ
Route::post('fish_records/comments/{id}/edit','FishRecordController@comment_edit')->name('comment_edit');

//コメント編集投稿ページ
Route::post('fish_records/comments/{id}/update','FishRecordController@comment_update')->name('comment_update');

//コメントの削除ページ
Route::delete('fish_records/comments/{id}/delete','FishRecordController@comment_delete')->name('comment_delete');

//釣り記録検索ページ
Route::get('fish_records_search','FishRecordController@index')->name('search');

//ユーザーメインページ
Route::get('mypage','UserController@top')->name('user');

//プロフィール編集ページ
Route::get('mypage/edit','UserController@edit')->name('user_edit');

//プロフィール編集実行
Route::post('mypage/edit/{id}','UserController@update')->name('user_update');

//フレンド検索ページ
Route::get('mypage/search_friends',function(){
    return view('friend_form');
});

//フレンド検索実行
Route::post('mypage/search_friends','UserController@friend')->name('search_friend');

//フレンド追加
Route::post('mypage/search_friends/add','UserController@add_friend')->name('add_friend');

//ログアウトページ
Route::get('/logout','Auth\LoginController@logout')->name('logout');

//フレンド一覧ページ
Route::get('mypage/friends','UserController@index')->name('friend_list');

//フレンドのプロフィールページ
Route::get('mypage/friends/{id}','UserController@friend_profile')->name('friend_profile');

//フレンドの解除
Route::delete('mypage/friends/{id}/delete','UserController@friend_delete')->name('friend_delete');

//通知ページ
Route::get('notices','NoticeController@notices')->name('notices');

//コメント通知のstate変更
Route::get('notices/{id}/comment','NoticeController@comment_notice_read')->name('comment_state');

//フレンド通知のstate変更
Route::get('notices/{id}/friend','NoticeController@friend_notice_read')->name('friend_state');