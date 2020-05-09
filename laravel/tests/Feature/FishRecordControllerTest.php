<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class FishRecordControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $response = $this->actingAs(User::find(3))->post(
            'fish_records',
            ['fishing_date' => '2020-04-29', 'harbor' => '東京湾', 'fish_name' => 'シーバス', 'size' => 50]
        );

        $response->assertRedirect(action('FishRecordController@index'));
    }

    public function test_index()
    {
        $response = $this->actingAs(User::find(3))->get('fish_records');

        $response->assertStatus(200)
            ->assertViewIs('fish_record_list')
            ->assertSee('釣り記録一覧');
    }

    public function test_edit()
    {
        $response = $this->actingAs(User::find(3))->post('fish_records/edit/5');

        $response->assertStatus(200)
            ->assertViewIs('fish_record_edit')
            ->assertSee('釣り記録修正');
    }

    public function test_update()
    {
        $response = $this->actingAs(User::find(3))->post(
            'fish_records/update/5',
            ['fishing_date' => '2020-04-29', 'harbor' => '東京湾', 'fish_name' => 'シーバス', 'size' => 50]
        );

        $response->assertRedirect(route('list'));
    }



    public function test_detalis()
    {
        $response = $this->actingAs(User::find(3))->get('fish_records/5');

        $response->assertStatus(200)
            ->assertViewIs('fish_record_detalis')
            ->assertSee('修正');
    }

    public function test_delete()
    {
        $response = $this->actingAs(User::find(3))->delete('fish_records/delete/5');

        $response->assertRedirect('fish_records');
    }

    public function test_comment()
    {
        $response = $this->actingAs(User::find(3))
            ->post('fish_records/5/comments', ['comment' => 'テスト', 'fish_record_id' => 5]);

        $response->assertRedirect('fish_records/5');
    }

    public function test_comment_edit()
    {
        $response = $this->actingAs(User::find(3))
            ->post('fish_records/comments/4/edit');

        $response->assertStatus(200)
            ->assertViewIs('comment_edit')
            ->assertSee('コメント修正');
    }
    public function test_comment_update()
    {
        $response = $this->actingAs(User::find(3))
            ->post('fish_records/comments/4/update', ['comment' => '修正テスト']);

        $response->assertRedirect('fish_records/5');
    }

    public function test_comment_delete()
    {
        $response = $this->actingAs(User::find(3))->delete('fish_records/comments/4/delete');

        $response->assertStatus(302);
    }
}
