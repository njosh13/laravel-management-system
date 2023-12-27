<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\{DB, Gate, Mail, Password};
use App\Models\{Role, Department, User, JobTitle};
use App\Mail\{NewUser};

class UserController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return inertia('Users/Index', [
            'users' => User::with('roles')->paginate(10)
        ]);
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return inertia('Users/CreateAndEditForm', [
            'roles' => Role::select(['id', 'name'])->get()
        ]);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name'     => ['string', 'required'],
            'email'    => ['required', 'unique:users',],
            'roles.*'  => ['integer'],
            'roles'    => ['required', 'array'],
        ]);

        //generate a password for the new user
        $pw = User::generatePassword();
        $formFields['password'] = $pw;

        $user = User::create($formFields);
        $user->markEmailAsVerified();
        $user->roles()->sync($request->input('roles', []));

        // Generate a new reset password token
        $token = app('auth.password.broker')->createToken($user);
        $email = $user->email;

        return redirect()->route('admin.users.index')->banner('User created successfully!');
    }

    public function show(User $user)
    {
        return inertia('Users/Show', [
            'user' => $user->load('roles')
        ]);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return inertia('Users/CreateAndEditForm', [
            'user' => $user,
            'roles' => Role::select(['id', 'name'])->get(),
            'role_user' => DB::table('role_user')->where('user_id', '=', $user->id)->get(),

        ]);
    }

    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name'     => ['string', 'required'],
            'email'    => ['required'],
            'roles.*'  => ['integer'],
            'roles'    => ['required', 'array'],
        ]);

        $user->update($formFields);
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index')->banner('User updated successfully!');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return redirect()->route('admin.users.index')->dangerBanner('User deleted successfully!');
    }
}
