<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserPersonal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        // if (
        //     !Auth::check()
        //     || !Auth::user()->is_admin
        // ) {
        //     redirect()->route('admin.auth.index');
        // }
    }

    /**s
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereNull('deleted_at')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create')
            ->with('pageTitle', 'Create User')
            ->with('user', new User)
            ->with('userPersonal', new UserPersonal);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create(User::filterInputs($validatedData));
        $validatedData['user_id'] = $user->id;
        UserPersonal::create(UserPersonal::filterInputs($validatedData));
        return $this->redirectAfterSave($request, $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit')
            ->with('user', $user)
            ->with('userPersonal', $user->userPersonal)
            ->with('pageTitle', 'Edit Use');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        }
        $validatedData['is_admin'] ??= false;
        $validatedData['is_author'] ??= false;
        $user->update(User::filterInputs($validatedData));
        $user->userPersonal->update(UserPersonal::filterInputs($validatedData));
        return $this->redirectAfterSave($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleted_at = now();
        $user->save();
        return redirect()->route('user.index');
    }

    protected function redirectAfterSave(Request $request, User $user)
    {
        if ($request->save === 'save_and_new') {
            return redirect()->route('user.create');
        }
        if ($request->save == 'save_and_exit') {
            return redirect()->route('user.index');
        }
        return redirect()->route('user.edit', ['user' => $user->id]);
    }
}
