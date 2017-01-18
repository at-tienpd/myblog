<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'birthday', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Many to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
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
     * Get all of the like posts that are assigned this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\Morphed By Many
     */
    public function likedPosts()
    {
        return $this->morphedByMany('App\Models\Post', 'likeable')->whereDeletedAt(null);
    }

    /**
     * Get all of the like comments that are assigned this tag.
     *
     * @return Illuminate\Database\Eloquent\Relations\Morphed By Many
     */
    public function likedComments()
    {
        return $this->morphedByMany('App\Models\Comment', 'likeable')->whereDeletedAt(null);
    }
}
