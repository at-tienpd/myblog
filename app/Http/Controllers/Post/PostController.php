<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use Session;

class PostController extends Controller
{
    /**
     * The Post instance.
     *
     * @var App\Models\Post
     */
    protected $postRepository;
    
    /**
     * Create a new PostRepository instance.
     *
     * @param PostRepository $postRepository PostRepository instance
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
}
