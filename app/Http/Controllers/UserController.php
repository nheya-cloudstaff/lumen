<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }

    public function validateRequest(Request $request) {
      $rules = [
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6'
      ];
      $this->validate($request, $rules);
    }


    //Get the input and create a user
    public function create(Request $request) {
        $this->validateRequest($request);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);
        return response()->json(['status' => "success", "id" => $user->id], 201);
    }


    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
