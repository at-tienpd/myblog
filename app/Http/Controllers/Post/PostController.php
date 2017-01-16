<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use App\Repositories\TagRepository;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
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
     * The User instance.
     *
     * @var App\Models\User
     */
    protected $userRepository;
    
    /**
     * Create a new PostRepository instance.
     *
     * @param PostRepository $postRepository PostRepository instance
     * @param TagRepository  $tagRepository  TagRepository instance
     * @param UserRepository $userRepository UserRepository instance
     */
    public function __construct(PostRepository $postRepository, TagRepository $tagRepository, UserRepository $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesNested = Category::getNestedList('name', null, '-');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        $tags = [];
        foreach ($post->tags as $tag) {
            array_push($tags, $tag->tag);
        }
        $categoriesNested = Category::getNestedList('name', null, '-');
        return view('post.edit', compact('categoriesNested', 'post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request post value
     * @param int                      $id      id post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $request->only('title', 'description', 'body', 'category_id');
        if ($request->hasFile('image')) {
            $image=$this->postRepository->uploadImagePost($request['image'], config('auth.image_path_post'));
            $post['image'] = $image;
        }
        $this->postRepository->update($post, $id);
        $postNew = $this->postRepository->find($id);
        $checkUpdateTag=$this->tagRepository->updateTag($request, $postNew);
        if ($checkUpdateTag) {
            Session::flash('message', trans('post.message.update'));
        } else {
            Session::flash('message', trans('post.message.update_tags_failed'));
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id id role
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->postRepository->find($id);
        $idUser = $post->user_id;
        $user = $this->userRepository->find($idUser);
        $this->postRepository->countView($id);
        return view('post.show', compact('post', 'user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $posts = $this->postRepository->paginate(config('paginate.admin.post'));
        return view('admin.post.publish', compact('posts'));
    }
}
