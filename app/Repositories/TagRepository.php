<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Tag;

class TagRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Tag constructor.
     *
     * @param Tag $model description
     *
     * @return void
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}
