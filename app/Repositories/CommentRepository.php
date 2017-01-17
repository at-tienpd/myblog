<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Comment constructor.
     *
     * @param Comment $model description
     *
     * @return void
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}
