<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register',[
            'sections' => Section::all(),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'max:255'],
            'phone' => ['required', 'unique:users', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required'],
            'trimester_no' => ['required'],
            'skills' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->student_id = $request->student_id;
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->email = $request->email;
        $user->trimester_no = $request->trimester_no;
        $user->section_id = $request->section_id;
        $user->major = $request->major;
        $user->skills = $request->skills;
        $user->achievements = $request->achievements;
        $user->other_contact_info = $request->other_contact_info;
        $user->status = 0;
        $user->password = Hash::make($request->password);
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        Toastr::success('Welcome to our website! '. $user->firstname);
        return redirect()->route('sections.index');
    }
}
