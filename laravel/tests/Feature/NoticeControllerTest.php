<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class NoticeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_notice()
    {
        $response = $this->actingAs(User::find(3))->get('notices');

        $response->assertStatus(200)
        ->assertViewIs('notice')
        ->assertSee('通知');
    }

    public function test_comment_notice_read()
    {
        $response = $this->actingAs(User::find(3))->get('notices/1/comment');

        $response->assertRedirect(route('detalis', ['id'=>4]));
    }

    public function test_friend_notice_read()
    {
        $response = $this->actingAs(User::find(3))->get('notices/1/friend');

        $response->assertRedirect(route('friend_profile', ['id'=>1]));
    }
}
