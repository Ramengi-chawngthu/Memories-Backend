<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [ //inputs are not empty or null
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $checkUser = User::where('name', $user->name)->orWhere('email', $user->email)->get();
        if (count($checkUser) > 0)
            return response()->json(['success' => false, 'message' => 'Username or email already exist']);
        $user->save();
        return response()->json(['success' => true, 'message' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function credentials(Request $request)
    {
        // $this->validate($request, [ //inputs are not empty or null
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);

        $user = new User;
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $checkUser = User::where('email', $user->email)->first();
        if ($checkUser) {
            if (Hash::check($user->password, $checkUser->password)) {
                return response()->json(['success' => true, 'message' => $checkUser]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Username or password is incorrect']);
    }
}
