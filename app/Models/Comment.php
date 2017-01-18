<?php

namespace App\Models;

use Baum\Node;
use Auth;

class Comment extends Node
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Column name which stores reference to parent's node.
     *
     * @var string
     */
    protected $parentColumn = 'parent_id';

    /**
     * Column name for the left index.
     *
     * @var string
     */
    protected $leftColumn = 'lft';

    /**
     * Column name for the right index.
     *
     * @var string
     */
    protected $rightColumn = 'rgt';

    /**
     * Column name for the depth field.
     *
     * @var string
     */
    protected $depthColumn = 'depth';

    /**
     * Column to perform the default sorting
     *
     * @var string
     */
    protected $orderColumn = null;

    /**
     * With Baum, all NestedSet-related fields are guarded from mass-assignment
     * by default.
     *
     * @var array
     */
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'body', 'status', 'user_id', 'post_id', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
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
