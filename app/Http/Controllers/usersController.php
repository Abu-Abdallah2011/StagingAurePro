<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Validation\Rules\Password;

class usersController extends Controller
{
    // Show Users Details in Database
    public function show()
    {
        return view('Users.users_database', ['users' => User::latest()
        ->filter(request(['search']))->paginate(10)
        ]);
    }

    // Show Users Registration Form For Admin
   public function create() {
    return view('Users.UsersRegister');
}

/**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users_database')->with('message', 'User saved Successfully!');
    }

       // Show Edit Form
public function edit($id){
    $user = User::find($id);
    return view('Users.edit_user', compact('user'));
}

// Edit User
public function update(UserUpdateRequest $request, $id){
        
    $data = $request->validated();

    $user = User::where('id', $id)->update($data);

    return redirect('/users_database')->with('message', 'User Updated Successfully!');;
}

// Delete User
public function delete($id) {
    $user = User::where('id', $id)->delete();
    return back()->with('message', 'User Deleted Successfully!');
}

}
