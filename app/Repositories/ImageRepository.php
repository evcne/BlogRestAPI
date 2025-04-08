<?php 

namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    public function createImage($data)
    {
        return Image::create($data); // Yeni bir resim kaydeder
    }

    public function deleteImage($image)
    {        
        return $image->delete();
    }

    public function getImageByPostId($id)
    {
        return Image::where('post_id', $id)->get();
    }
}
