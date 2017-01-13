<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Session;

class CategoryController extends Controller
{
    /**
     * The Category instance.
     *
     * @var App\Models\Category
     */
    protected $categoryRepository;

    /**
     * The Post instance.
     *
     * @var App\Models\Post
     */
    protected $postRepository;
    
    /**
     * Create a new CategoryRepository instance.
     *
     * @param CategoryRepository $categoryRepository CategoryRepository instance
     * @param PostRepository     $postRepository     PostRepository instance
     */
    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    // *
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
     
    // public function index()
    // {
    //     //
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->paginate(config('paginate.admin.category.add'));
        $categoriesNested = Category::getNestedList('name');
        return view('admin.category.add', compact('categories', 'categoriesNested'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreCategoryRequest $request description
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category(['name' => $request->name]);
        if ($request ->parent_id !== 'root') {
            $category->parent_id = $request->parent_id;
        }
        $category->save();
        Session::flash('message', trans('category.message.store'));
        return back();
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->paginate(config('paginate.admin.category.edit'));
        $category = $this->categoryRepository->find($id);
        $categoriesNested = Category::getNestedList('name');
        return view('admin.category.edit', compact('categories', 'categoriesNested', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateCategoryRequest $request description
     * @param int                                    $id      id category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $request->only('name', 'parent_id');
        if ($request ->parent_id !== 'root') {
            $category['parent_id'] = $request->parent_id;
        } else {
            $category['parent_id'] = null;
        }
        $this->categoryRepository->update($category, $id);
        Category::rebuild();
        Session::flash('message', trans('category.message.update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        $this->postRepository->deleteBy($id);
        Session::flash('message', trans('category.message.delete'));
        Category::rebuild();
        return back();
    }
}
