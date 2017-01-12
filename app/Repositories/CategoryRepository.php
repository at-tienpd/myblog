<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Category constructor.
     *
     * @param Category $model description
     *
     * @return void
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
