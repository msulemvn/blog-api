<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function index()
    {
        $posts = $this->posts->all();

        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $post = $this->posts->create($request->all());

        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
