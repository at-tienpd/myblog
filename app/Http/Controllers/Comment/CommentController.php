<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Http\Requests\StoreCommentRequest;
use Auth;
use Session;

class CommentController extends Controller
{
    /**
     * The Comment instance.
     *
     * @var App\Models\Comment
     */
    protected $commentRepository;
    
    /**
     * Create a new CommentRepository instance.
     *
     * @param CommentRepository $commentRepository CommentRepository instance
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request value request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment(['body' => $request->body, 'user_id' => Auth::user()->id, 'post_id' => $request->post_id]);
        if (isset($request ->parent_id)) {
            $comment->parent_id = $request->parent_id;
        }
        $comment->save();
        Session::flash('message', trans('comment.message.store'));
        return back();
    }
}
