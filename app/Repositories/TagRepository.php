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
     * @param Illuminate\Http\Request $request request
     * @param Post instance           $post    post
     *
     * @return mixed
     */
    public function storeTag($request, $post)
    {
        if ($request['tags'] != '') {
            $tags = explode(',', $request['tags']);
            foreach ($tags as $tag) {
                $tagCheck = Tag::where('tag', $tag)->first();
                if (is_null($tagCheck)) {
                    $tagNew = new Tag;
                    $tagNew->tag = $tag;
                    $tagNew->save();
                    $post->tags()->attach($tagNew->id);
                } else {
                    $post->tags()->attach($tagCheck->id);
                }
            }
        }
    }
}
