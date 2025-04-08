<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;


class PostAPIController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        try {

            return response()->json($this->postService->getAllPosts(), 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {

            return response()->json($this->postService->getPostById($id));

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function store(StorePostRequest $request)
    {
    
        try {

            $validated = $request->validated();
            return response()->json($this->postService->createPost($validated), 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function update(StorePostRequest $request, $id)
    {
        try {

            if ($id != Auth::id()) {
                return response()->json(['message' => 'Sadece kendi postlarınızı güncelleyebilirisiniz.'], 405);
            }

            $validated = $request->validated();
            return response()->json($this->postService->updatePost($id, $validated));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function delete($id)
    {
        try {

            if ($id != Auth::id()) {
                return response()->json(['message' => 'Sadece kendi postlarınızı silebilirsiniz.'], 405);
            }

            return response()->json(['message' => 'Post Deleted', 'data' => $this->postService->deletePost($id)], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }
}
