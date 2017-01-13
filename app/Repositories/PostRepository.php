<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Post constructor.
     *
     * @param Post $model description
     *
     * @return void
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    /**
     * Upload image for post.
     *
     * @param file   $image file image
     * @param string $path  the image path
     *
     * @return string image name
     */
    public function uploadImagePost($image, $path)
    {
        $nameImage =time().'-'.$image->getClientOriginalName();
        $image->move($path, $nameImage);
        return $nameImage;
    }

     /**
     * Delete item by field value
     *
     * @param int $value field value
     *
     * @return mixed
     */
    public function deleteBy($value)
    {
        return $this->model->where('category_id', '>=', $value)->delete();
    }
}
