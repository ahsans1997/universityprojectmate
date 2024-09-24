<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function show(UserGroup $userGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserGroup $userGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserGroup $userGroup)
    {
        DB::beginTransaction();
        try {
            $userGroup = UserGroup::where('group_id', $request->group_id)->where('user_id', $request->user_id)->first();
            $userGroup->status = 1;
            $userGroup->save();

            $user = User::findOrFail($request->user_id);
            $user->status = 1;
            $user->save();

            DB::commit();

            Toastr::success('User added to group successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserGroup $userGroup)
    {
        DB::beginTransaction();
        try {
            $userGroup = UserGroup::where('group_id', $userGroup->group_id)->where('user_id', $userGroup->user_id)->first();
            $userGroup->delete();

            $user = User::findOrFail($userGroup->user_id);
            $user->status = 1;
            $user->save();

            DB::commit();

            Toastr::success('User removed from group successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }

    public function groupUser($id)
    {
        return view('groups.userList',[
            'groupUsers' => UserGroup::where('group_id', $id)->where('status', 1)->get(),
            'group' => Group::findOrFail($id),
            'title' => 'Joined User List',
        ]);
    }
}
