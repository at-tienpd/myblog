<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Tag;

class TagRepository extends BaseRepository
{
    protected $model;
    
    /**
     * Tag constructor.
     *
     * @param Tag $model description
     *
     * @return void
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * Store tags
     *
     * @param Illuminate\Http\Request $inputs request
     * @param App\Models\Post         $post   post
     *
     * @return mixed
     */
    public function storeTag($inputs, $post)
    {
        if ($inputs['tags'] != '') {
            $tags = explode(',', $inputs['tags']);
            foreach ($tags as $tag) {
                if (trim($tag) !== '') {
                    $tagCheck = Tag::where('tag', $tag)->first();
                    if (is_null($tagCheck)) {
                        $tagNew = new Tag;
                        $tagNew->tag = trim($tag);
                        $tagNew->save();
                        $post->tags()->attach($tagNew->id);
                    } else {
                        $post->tags()->attach($tagCheck->id);
                    }
                }
            }
        }
    }

    /**
     * Update tags.
     *
     * @param array           $inputs value array tags
     * @param App\Models\Post $post   post
     *
     * @return void
     */
    public function updateTag($inputs, $post)
    {
        $tagsId = [];
        if ($inputs['tags'] != '') {
            $tags = explode(',', $inputs['tags']);
            foreach ($tags as $tag) {
                if (trim($tag) !== '') {
                    $tagNew = Tag::where('tag', trim($tag))->first();
                    if (is_null($tagNew)) {
                        $tagNew = new Tag;
                        $tagNew->tag = trim($tag);
                        $tagNew->save();
                    }
                    array_push($tagsId, $tagNew->id);
                }
            }
        }
        if (!empty($tagsId)) {
            $post->tags()->sync($tagsId);
            return true;
        } else {
            return false;
        }
    }
}
