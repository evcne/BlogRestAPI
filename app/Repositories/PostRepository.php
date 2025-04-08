<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\Image;


class PostRepository
{
    public function getAllPosts()
    {
        return Post::with('username','images')->all();
//        Post::all(); 
    }

    public function getPostById($id)
    {
        return Post::with('username', 'images')->findOrFail($id);
    }

    public function createPost($validated, $userId)
    {
        $post = Post::create([
            'user_id' => $userId,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);


        if ($validated['images']) {
            foreach ($validated['images'] as $imagePath) {
                Image::create([
                    'post_id' => $post->id,
                    'path' => $imagePath,
                ]);
            }
        }

        return Post::with('images')->findOrFail($post->id);
    }

    public function updatePost($id, $data)
    {
        $post = Post::findOrFail($id);
        //$post->update($data->only(['title', 'content']));
        //$post->update($data); // Post'u günceller

        $post->update($data);

        if ($data['images']) {
            $image = Image::where('post_id', $id)->get();

            $image->each(function ($image) {
                $image->delete();
            });
        
            foreach ($data['images'] as $imagePath) {
                Image::create([
                    'post_id' => $post->id,
                    'path' => $imagePath,
                ]);
            }
        }

        return $post;
    }

    public function deleteImagesByPostId($postId)
    {
        return Image::where('post_id', $postId)->delete();
    }

    

    public function addImagesToPost($postId, $images)
    {
        foreach ($images as $imagePath) {
            Image::create([
                'post_id' => $postId,
                'path' => $imagePath,
            ]);
        }
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        

        return $post->delete(); // Post'u siler
    }
}
