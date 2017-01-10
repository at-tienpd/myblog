<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Role;

class RoleRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Product constructor.
     *
     * @param Product $model description
     *
     * @return void
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
