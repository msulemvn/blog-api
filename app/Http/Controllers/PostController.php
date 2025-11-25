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

    /**
     * @OA\Get(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Get all posts",
     *     description="Retrieve a list of all posts",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Posts retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Posts retrieved successfully"),
     *             @OA\Property(property="statusCode", type="integer", example=200),
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="data", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Sample Post Title"),
     *                     @OA\Property(property="content", type="string", example="This is the post content"),
     *                     @OA\Property(property="author_id", type="integer", example=1),
     *                     @OA\Property(property="status", type="string", example="published"),
     *                     @OA\Property(property="published_at", type="string", format="date-time", example="2025-11-25T10:00:00Z"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $posts = $this->posts->all();

        return $this->success(
            PostResource::collection($posts),
            'Posts retrieved successfully'
        );
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     tags={"Posts"},
     *     summary="Create a new post",
     *     description="Create a new blog post",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"title","content","author_id"},
     *
     *             @OA\Property(property="title", type="string", example="My New Blog Post"),
     *             @OA\Property(property="content", type="string", example="This is the content of my blog post"),
     *             @OA\Property(property="author_id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="draft", description="Status: draft or published"),
     *             @OA\Property(property="published_at", type="string", format="date-time", example="2025-11-25T10:00:00Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Post created successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post created successfully"),
     *             @OA\Property(property="statusCode", type="integer", example=201),
     *             @OA\Property(property="status", type="string", example="Created"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="My New Blog Post"),
     *                 @OA\Property(property="content", type="string", example="This is the content of my blog post"),
     *                 @OA\Property(property="author_id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="draft"),
     *                 @OA\Property(property="published_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="The title field is required."),
     *             @OA\Property(property="statusCode", type="integer", example=422),
     *             @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $post = $this->posts->create($request->all());

        return $this->success(
            new PostResource($post),
            'Post created successfully',
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Get a specific post",
     *     description="Retrieve a single post by ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post retrieved successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post retrieved successfully"),
     *             @OA\Property(property="statusCode", type="integer", example=200),
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Sample Post Title"),
     *                 @OA\Property(property="content", type="string", example="This is the post content"),
     *                 @OA\Property(property="author_id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="published"),
     *                 @OA\Property(property="published_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Post not found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post not found")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $post = $this->posts->find($id);

            return $this->success(
                new PostResource($post),
                'Post retrieved successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), null, 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Update a post",
     *     description="Update an existing blog post",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="title", type="string", example="Updated Post Title"),
     *             @OA\Property(property="content", type="string", example="Updated content"),
     *             @OA\Property(property="author_id", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="published"),
     *             @OA\Property(property="published_at", type="string", format="date-time", example="2025-11-25T10:00:00Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post updated successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post updated successfully"),
     *             @OA\Property(property="statusCode", type="integer", example=200),
     *             @OA\Property(property="status", type="string", example="OK"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Updated Post Title"),
     *                 @OA\Property(property="content", type="string", example="Updated content"),
     *                 @OA\Property(property="author_id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="published"),
     *                 @OA\Property(property="published_at", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Post not found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="statusCode", type="integer", example=422),
     *             @OA\Property(property="status", type="string", example="Unprocessable Entity"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $post = $this->posts->update($id, $request->all());

            return $this->success(
                new PostResource($post),
                'Post updated successfully'
            );
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), null, 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/posts/{id}",
     *     tags={"Posts"},
     *     summary="Delete a post",
     *     description="Delete an existing blog post",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Post ID",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Post deleted successfully",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post deleted successfully"),
     *             @OA\Property(property="statusCode", type="integer", example=200),
     *             @OA\Property(property="status", type="string", example="OK")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Post not found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Post not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthorized")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $this->posts->delete($id);

            return $this->success([], 'Post deleted successfully', Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('Post not found', null, 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), null, 500);
        }
    }
}
