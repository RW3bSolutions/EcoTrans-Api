<?php

namespace App\Http\Controllers\Api\SystemPortal;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index (Request $request)
    {
        return User::where('portal', 'System')->get();
    }

    public function store (Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'portal' => 'required|in:System,Employee',
            'role' => 'required|in:Admin,HR,Accounting',
        ]);

        return User::create($request->all());
    }

    public function update (Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'role' => 'required|in:Admin,HR,Accounting',
        ]);

        return $user->update($request->all());
    }

}
