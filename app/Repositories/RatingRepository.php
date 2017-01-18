<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use willvincent\Rateable\Rating;
use Auth;

class RatingRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Comment constructor.
     *
     * @param Comment $model description
     *
     * @return void
     */
    public function __construct(Rating $model)
    {
        $this->model = $model;
    }

    /**
     * Publish post
     *
     * @param int $rateableId rateable id
     *
     * @return mixed
     */
    public function countRating($rateableId)
    {
        return $this->model->where('rateable_id', $rateableId)->where('user_id', Auth::id())->count();
    }
}
