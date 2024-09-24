<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\User;
use App\Models\UserGroup;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sections.index',[
            'sections' => Section::all(),
            'title' => 'Sections List'
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
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $section = new Section();
        $section->code = $request->code;
        $section->name = $request->name;
        $section->save();

        Toastr::success('Section Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        $sectionInfo = Section::findOrFail($section->id);
        $groupId = Group::where('section_id', $sectionInfo->id)->pluck('id');
        return view('groups.index',[
            'sectionInfo' => $sectionInfo,
            'sectionGroups' => Group::where('section_id', $sectionInfo->id)->get(),
            'userGroup' => UserGroup::all(),
            'requestGroup' => UserGroup::where('user_id', Auth::user()->id)->count(),
            'title' => $sectionInfo->name. ' Group List',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return Section::findOrFail($section->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $section = Section::findOrFail($section->id);
        $section->code = $request->code;
        $section->name = $request->name;
        $section->save();

        Toastr::success('Section Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        if(Group::where('section_id', $section->id)->exists()){
            Toastr::error('Section has groups. Please delete groups first');
            return redirect()->back();
        }

        if(User::where('section_id', $section->id)->exists()){
            Toastr::error('Section has users. Please delete users first');
            return redirect()->back();
        }

        $section = Section::findOrFail($section->id);
        $section->delete();

        Toastr::success('Section Deleted Successfully');
        return redirect()->back();
    }
}
