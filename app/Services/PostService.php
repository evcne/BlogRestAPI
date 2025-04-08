<?php
namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\ImageRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $postRepository;
    protected $imageRepository;

    public function __construct(PostRepository $postRepository, ImageRepository $imageRepository)
    {
        $this->postRepository = $postRepository;
        $this->imageRepository = $imageRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function createPost($data)
    {

        return $this->postRepository->createPost($data, Auth::id());
    }

    public function updatePost($id, $data)
    {

        $post = $this->postRepository->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        

        return $this->postRepository->updatePost($id, $data);
    }

    public function deletePost($id)
    {
        $post = $this->postRepository->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $image = $this->imageRepository->getImageByPostId($id);
        if (!$image) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $image->each(function ($image) {
            $this->imageRepository->deleteImage($image);
        });

        return $this->postRepository->deletePost($id);
    }
}
