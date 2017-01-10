<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Permission constructor.
     *
     * @param Permission $model description
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
