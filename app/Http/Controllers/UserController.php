<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\User;
use App\Models\UserGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index',[
            'users' => User::all(),
            'title' => 'Users List',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('users.show',[
            'user' => User::find($id),
            'title' => 'User Profile',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('users.edit',[
            'user' => User::find($id),
            'sections' => Section::all(),
            'title' => 'Edit User',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'max:255'],
            'phone' => ['required'],
            'department' => ['required', 'string', 'max:255'],
            'trimester_no' => ['required'],
            'skills' => ['required'],
        ]);

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->student_id = $request->student_id;
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->trimester_no = $request->trimester_no;
        $user->section_id = $request->section_id;
        $user->major = $request->major;
        $user->skills = $request->skills;
        $user->achievements = $request->achievements;
        $user->other_contact_info = $request->other_contact_info;
        $user->save();

        Toastr::success('User Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(UserGroup::where('user_id', $id)->count() > 0){
            Toastr::error('User is in a group. Remove user from group first');
            return redirect()->back();
        }

        if(Group::where('user_id', $id)->count() > 0){
            Toastr::error('User is a group leader. Remove user from group first');
            return redirect()->back();
        }

        User::find($id)->delete();

        Toastr::success('User Deleted Successfully');
        return redirect()->back();
    }

    public function makeAdmin(Request $request)
    {
        if(User::where('is_admin', 1)->count() == 1){
            Toastr::error('At least one user should be admin');
            return redirect()->back();
        }

        $user = User::find($request->user_id);
        if($user->is_admin == 1){
            $user->is_admin = 0;
            $user->save();
            Toastr::success('User Role Updated Successfully');
            return redirect()->back();
        }else{
            $user->is_admin = 1;
            $user->save();
            Toastr::success('User Role Updated Successfully');
            return redirect()->back();
        }

        Toastr::success('User Role Updated Successfully');
        return redirect()->back();
    }
}
