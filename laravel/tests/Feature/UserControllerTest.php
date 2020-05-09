<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_mypage()
    {

        $response = $this->actingAs(User::find(3))->get('mypage');

        $response->assertStatus(200)
            ->assertViewIs('user_top')
            ->assertSee('釣り記録投稿');
    }

    public function test_edit()
    {
        $response = $this->actingAs(User::find(3))->get('mypage/edit');

        $response->assertStatus(200)
            ->assertViewIs('user_edit')
            ->assertSee('プロフィール編集');
    }

    public function test_update()
    {
        $response = $this->actingAs(User::find(3))->post(route('user_update',['id'=>3]), ['name' => 'とまと','email'=>'ccc@ccc']);

        $response->assertRedirect('mypage');       
    }

    public function test_friend()
    {
        $response = $this->actingAs(User::find(3))->post(route('search_friend'), ['name' => 'どせいさん']);

        $response->assertStatus(200)
            ->assertViewIs('friend_search')
            ->assertSee('フレンド検索結果');
    }

    public function test_add_friend()
    {
        $response = $this->actingAs(User::find(3))->post(route('add_friend'), ['friend_id' => 2]);

        $response->assertRedirect(route('search_friend'));
    }

    public function index()
    {
        $response = $this->actingAs(User::find(3))->get('mypage/friends');

        $response->assertStatus(200)
        ->assertViewIs('friend_list')
        ->assertSee('フレンド一覧');
    }

    public function test_friend_profile()
    {
        $response = $this->actingAs(User::find(3))->get('mypage/friends/2');

        $response->assertStatus(200)
        ->assertViewIs('friend_profile')
        ->assertSee('どせいさん');
    }

    public function test_delete_friend()
    {
        $response = $this->actingAs(User::find(3))->delete('mypage/friends/2/delete');

        $response->assertRedirect(route('friend_list'));
    }
}
