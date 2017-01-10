<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    /**
     * The Role instance.
     *
     * @var App\Models\Role
     */
    protected $roleRepository;
    
    /**
     * Create a new RoleRepository instance.
     *
     * @param RoleRepository $roleRepository RoleRepository instance
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
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
        $roles = $this->roleRepository->all();
        return view('admin.role.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request store role
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = $request->only('name', 'description', 'display_name');
        $this->roleRepository->create($role);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id id role
     *
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id role
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = $this->roleRepository->all();
        $role = $this->roleRepository->find($id);
        return view('admin.role.edit', compact('roles', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request role value
     * @param int                      $id      id role
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = $request->only('name', 'description', 'display_name');
        $this->roleRepository->update($role, $id);
        return redirect()->route('roles.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id role
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleRepository->delete($id);
        return back();
    }
}
