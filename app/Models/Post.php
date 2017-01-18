<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use willvincent\Rateable\Rateable;

class Post extends Model
{
    use Rateable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'image', 'description', 'body', 'view', 'status', 'user_id', 'category_id'];

    /**
     * Many to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
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

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\Has Many
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * Get all of the users like post that are assigned this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\Morphed By Many
     */
    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }

    /**
     * Check user like or not like.
     *
     * @return status like of user
     */
    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (!is_null($like)) ? true : false;
    }
}
