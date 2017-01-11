<?php

namespace App\Http\Controllers\User;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetRoleRequest;
use Auth;
use App\Providers\SocialAccountService;
use Socialite;

class UserController extends Controller
{
    /**
     * The Role instance.
     *
     * @var App\Models\Role
     */
    protected $roleRepository;

    /**
     * The User instance.
     *
     * @var App\User
     */
    protected $userRepository;

    /**
     * Create a new UserRepository instance.
     *
     * @param App\Models\Role $roleRepository RoleRepository instance
     * @param App\User        $userRepository UserRepository instance
     *
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * List all user for set role.
     *
     * @return view
     */
    public function listUserByRole()
    {
        $roles = $this->roleRepository->all();
        $users = $this->userRepository->all();
        return view('admin.role.role_user', compact('roles', 'users'));
    }

    /**
     * Set role for user.
     *
     * @param \Illuminate\Http\Request $request role
     *
     * @return \Illuminate\Http\Response
     */
    public function setRole(Request $request)
    {
        $input = $request->all();
        $roles = $this->roleRepository->all();
        $usersSync = [];
        foreach ($roles as $role) {
            if (isset($input['roles'][$role->id])) {
                $usersSync = $input['roles'][$role->id]['users'];
                $role->users()->sync($usersSync);
            }
        }
        return back();
    }

    /**
     * Redirect user.
     *
     * @param provider $provider provider
     *
     * @return redirect
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Set role for user.
     *
     * @param App\Providers\SocialAccountService $service  service
     * @param provider                           $provider provider
     *
     * @return redirect
     */
    public function callback(SocialAccountService $service, $provider)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider));
        auth()->login($user);
        return redirect()->to('/home');
    }
}
