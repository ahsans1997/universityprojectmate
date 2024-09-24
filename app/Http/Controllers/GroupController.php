<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\UserGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'name' => 'required',
            'max_users' => 'required',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->max_users = $request->max_users;
        $group->section_id = $request->section_id;
        $group->save();

        Toastr::success('Group created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return Group::findOrFail($group->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required',
            'max_users' => 'required',
        ]);

        $group = Group::findOrFail($group->id);
        $group->name = $request->name;
        $group->max_users = $request->max_users;
        $group->save();

        Toastr::success('Group updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        if(UserGroup::where('group_id', $group->id)->exists()){
            Toastr::error('Group has users');
            return redirect()->back();
        }
        $group = Group::findOrFail($group->id);
        $group->delete();

        Toastr::success('Group deleted successfully');
        return redirect()->back();
    }

    public function joinGroup(Group $group)
    {

        if(UserGroup::where('user_id', Auth::user()->id)->where('group_id', $group->id)->exists()){
            Toastr::error('You have already requested to join this group');
            return redirect()->back();
        }

        if(UserGroup::where('group_id', $group->id)->where('status', 1)->count() >= $group->max_users){
            Toastr::error('Group is full');
            return redirect()->back();
        }

        $userGroup = new UserGroup();
        $userGroup->user_id = Auth::user()->id;
        $userGroup->group_id = $group->id;
        $userGroup->status = 0;
        $userGroup->save();

        Toastr::success('You have request the group');
        return redirect()->back();
    }

    public function userRequestList(Group $group)
    {
        $requestUserList = UserGroup::where('group_id', $group->id)->where('status', 0)->get();
        return view('groups.requestUserList', [
            'requestUserList' => $requestUserList,
            'group' => $group,
            'title' => 'User Request List'
        ]);
    }
}
