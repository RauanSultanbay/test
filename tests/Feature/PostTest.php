<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class PostTest extends TestCase
{

    public function test_get_all_posts()
    {
        $response = $this->get('/api/posts')->assertStatus(200);
    }

    public function test_show_post()
    {
        $post = Post::factory()->create();
        $this->get('/api/posts/'.$post->id)
            ->assertStatus(200);
    }

    public function test_check_validation()
    {
        $this->json('POST', '/api/posts', [])
            ->assertStatus(422);
    }

    public function test_creating_post()
    {
        $data = [
            'name' => 'Name',
            'description' => 'Description',
            'body' => 'Text',
            'published_date' => '2020-01-12',
            'is_published' => true,
        ];
        $this->json('POST', '/api/posts', $data)
            ->assertStatus(200);
    }

    public function test_delete_post()
    {
        $post = Post::factory()->create();
        $this->delete('/api/posts/'.$post->id)
            ->assertStatus(204);
    }
}
