<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagRepository->paginate(config('paginate.admin.tag.add'));
        return view('admin.tag.add', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreCategoryRequest $request description
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        $tag = $request->only('tag');
        $this->tagRepository->create($tag);
        Session::flash('message', trans('tag.message.store'));
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
        $tags = $this->tagRepository->paginate(config('paginate.admin.tag.edit'));
        $tag = $this->tagRepository->find($id);
        return view('admin.tag.edit', compact('tags', 'tag'));
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
        $this->tagRepository->delete($id);
        Session::flash('message', trans('tag.message.delete'));
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request post value
     * @param int                      $id      id post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
        $tag = $request->only('tag');
        $this->tagRepository->update($tag, $id);
        Session::flash('message', trans('tag.message.update'));
        return back();
    }
}
