<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Permission constructor.
     *
     * @param Permission $model description
     *
     * @return void
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
