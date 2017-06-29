<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {


    /*
     * Method used to display list of all users.
     */
    public function displayAllUsers() {

        $users = User::orderBy('created_at', 'ASC')->paginate(5);

        return view('users.displayAllUsers', ['users' => $users]);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     *
     * Method used to handle updating user roles and is_active status
     */


    public function updateUser(Request $request) {

        //Finding user by hidden id field.
        $user = User::find($request->input('id'));

        //Detaching all except user_role.
        $user->roles()->detach([1, 2]);

        //Assigning new roles to user. ( role_user can't be cahanged ).
        if ($request->input('role_moderator')) {
            $user->roles()->attach(2);

        }
        if ($request->input('role_admin')) {
            $user->roles()->attach(1);
        }

        //In every form submit , we deactivate user, but based on request that we will activate it again or leave it deactivated.
        $user->is_active = 0;

        //If checkbox is checked we will activate user.
        if ($request->input('is_active')) {
            $user->is_active = 1;
            $user->save();
            return redirect()->back()->with('verify', 'Update was successfully!');
        } else {
            //If checkbox is not checked we will leave user deactivated.
            $user->save();
        }
        return redirect()->back()->with('verify', 'Update was successfully!');

    }












}
