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

    /**
     * Create select html.
     *
     * @param Category $root description
     *
     * @return string
     */
    public function printSelect($root)
    {
        $html = '';
        $html .= "<select class='form-control' name='parent_id'>";
        $html .= '<option value="root">--Choice parent category--</option>';
        foreach ($root as $r) {
            $html .= $this->printOption($r);
        }
        $html .= "</select>";
        return $html;
    }

    /**
     * Create option html.
     *
     * @param Category $node description
     *
     * @return string
     */
    public function printOption($node)
    {
        $level = $node->getLevel();
        $indent = "";
        for ($i = 0; $i < $level; $i++) {
            $indent .= "--";
        }
        $html = '<option value="'.$node->id . '">'.$indent . $node->name . '</option>';
        foreach ($node->children as $child) {
            $html .= $this->printOption($child);
        }
        return $html;
    }
}
