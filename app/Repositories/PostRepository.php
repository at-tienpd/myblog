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
}
