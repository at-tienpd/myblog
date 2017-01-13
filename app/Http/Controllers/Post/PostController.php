<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\TagRepository;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use Session;
use Auth;

class PostController extends Controller
{
    /**
     * The Post instance.
     *
     * @var App\Models\Post
     */
    protected $postRepository;

    /**
     * The Tag instance.
     *
     * @var App\Models\Tag
     */
    protected $tagRepository;
    
    /**
     * Create a new PostRepository instance.
     *
     * @param PostRepository $postRepository PostRepository instance
     * @param TagRepository  $tagRepository  TagRepository instance
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesNested = Category::getNestedList('name');
        return view('post.add', compact('categoriesNested'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreCategoryRequest $request description
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $image=$this->postRepository->uploadImagePost($request['image'], config('auth.image_path_post'));
        $post = $request->only('title', 'description', 'body', 'category_id');
        $post['image'] = $image;
        $post['user_id'] = Auth::user()->id;
        $postId = $this->postRepository->create($post)->id;
        $postNew = $this->postRepository->find($postId);
        $this->tagRepository->storeTag($request, $postNew);
        Session::flash('message', trans('post.message.store'));
        return back();
    }
}
