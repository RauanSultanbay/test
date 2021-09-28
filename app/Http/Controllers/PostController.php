<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public function index()
    {
        return response(PostResource::collection(Post::all()), 200);
    }

    public function store(PostRequest $request)
    {
        $post = Post::create($request->except('main_image'));
        $post->saveImage($request);
        return response(PostResource::make($post), 200);
    }

    public function show(Post $post)
    {
        return response(PostResource::make($post),200);
    }


    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->except('main_image'));
        $post->saveImage($request);
        return response(PostResource::make($post), Response::HTTP_CREATED);
    }


    public function destroy(Post $post)
    {
        $post->removeImage();
        $post->delete();
        return response(['message' => 'Post is deleted'], 204);
    }
}
