<?php

namespace App\Models;

use Baum\Node;

class Category extends Node
{
  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'categories';

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
    protected $guarded = ['id', 'parent_id', 'lft', 'rgt', 'depth'];

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'parent_id', 'lft', 'rgt', 'depth'];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
}
