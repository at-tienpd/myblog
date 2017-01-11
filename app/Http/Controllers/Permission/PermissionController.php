<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Session;

class PermissionController extends Controller
{
    /**
     * The Permission instance.
     *
     * @var App\Models\Permission
     */
    protected $permissionRepository;
    
    /**
     * Create a new PermissionRepository instance.
     *
     * @param PermissionRepository $permissionRepository PermissionRepository instance
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
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
        $permissions = $this->permissionRepository->paginate(config('paginate.admin.permission.edit'));
        return view('admin.permission.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request value request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = $request->only('name', 'description', 'display_name');
        $this->permissionRepository->create($permission);
        Session::flash('message', trans('permission.message.store'));
        return back();
    }

    // *
    //  * Display the specified resource.
    //  *
    //  * @param int $id
    //  *
    //  * @return \Illuminate\Http\Response
     
    // // public function show($id)
    // // {
    // //     //
    // // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id permission
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = $this->permissionRepository->paginate(config('paginate.admin.permission.edit'));
        $permission = $this->permissionRepository->find($id);
        return view('admin.permission.edit', compact('permissions', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request value request
     * @param int                      $id      id permission
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = $request->only('name', 'description', 'display_name');
        $this->permissionRepository->update($permission, $id);
        Session::flash('message', trans('permission.message.update'));
        return redirect()->route('permissions.create');
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
        $this->permissionRepository->delete($id);
        Session::flash('message', trans('permission.message.delete'));
        return back();
    }
}
