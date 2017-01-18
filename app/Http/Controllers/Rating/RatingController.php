<?php

namespace App\Http\Controllers\Rating;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use willvincent\Rateable\Rating;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Http\Requests\StoreRatingRequest;
use Auth;
use Session;

class RatingController extends Controller
{
    /**
     * The Post instance.
     *
     * @var App\Models\Post
     */
    protected $postRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new PostRepository instance.
     *
     * @param PostRepository $postRepository PostRepository instance
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreRatingRequest $request Value input request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingRequest $request)
    {
        $post = $this->postRepository->find($request->post_id);
        $rating = new Rating;
        $rating->rating = $request->rating;
        $rating->user_id = Auth::id();
        $post->ratings()->save($rating);
        Session::flash('message', trans('rating.message.store'));
        return back();
    }
}
