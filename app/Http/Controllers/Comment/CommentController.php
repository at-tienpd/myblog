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
        $this->middleware('admin')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentRepository->paginate(config('paginate.admin.comment'));
        return view('admin.comment.list', compact('comments'));
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

    /**
     * Publish comment.
     *
     * @param \Illuminate\Http\Request $request description
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        if ($request->status == true) {
            $this->commentRepository->unpublishComment($request->id);
        } else {
            $this->commentRepository->publishComment($request->id);
        }
        Session::flash('message', trans('comment.message.status'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id permission
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->commentRepository->delete($id);
        Session::flash('message', trans('comment.message.delete'));
        return back();
    }
}
