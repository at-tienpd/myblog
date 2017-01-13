<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Session;

class TagController extends Controller
{
    /**
     * The Tag instance.
     *
     * @var App\Models\Tag
     */
    protected $tagRepository;
    
    /**
     * Create a new TagRepository instance.
     *
     * @param TagRepository $tagRepository TagRepository instance
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }
}
