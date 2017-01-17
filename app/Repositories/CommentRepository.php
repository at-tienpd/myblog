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

    /**
     * Publish post
     *
     * @param int $id post id
     *
     * @return boolean
     */
    public function publishComment($id)
    {
        return $this->model->where('id', $id)->update(['status' => true]);
    }

    /**
     * Unpublish post
     *
     * @param int $id post id
     *
     * @return boolean
     */
    public function unpublishComment($id)
    {
        return $this->model->where('id', $id)->update(['status' => false]);
    }
}
