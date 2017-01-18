<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likeables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];

    /**
     * Get all of the like comments that are assigned this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\Morphed By Many
     */
    public function comments()
    {
        return $this->morphedByMany('App\Models\Comment', 'likeable');
    }

    /**
     * Get all of the like posts that are assigned this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\Morphed By Many
     */
    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'likeable');
    }

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
