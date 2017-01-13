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
        //
    }

    // *
    //  * Store a newly created resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
     
    // public function store(Request $request)
    // {
    //     //
    // }

    // *
    //  * Display the specified resource.
    //  *
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
     
    // public function show($id)
    // {
    //     //
    // }

    // *
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param int $id
    //  *
    //  * @return \Illuminate\Http\Response
     
    // public function edit($id)
    // {
    //     //
    // }

    // *
    //  * Update the specified resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @param int                      $id
    //  *
    //  * @return \Illuminate\Http\Response
     
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // *
    //  * Remove the specified resource from storage.
    //  *
    //  * @param int $id
    //  *
    //  * @return \Illuminate\Http\Response
     
    // public function destroy($id)
    // {
    //     //
    // }
}
