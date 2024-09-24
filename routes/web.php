<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('sections.index');
});

Route::middleware('auth')->group(function () {
// User
    Route::resource('users', UserController::class);
    Route::post('make/admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');

//Section
    Route::resource('sections', SectionController::class);

//Group
    Route::resource('groups', GroupController::class);
    Route::get('request/join/group/{group}', [GroupController::class, 'joinGroup'])->name('groups.join');
    Route::get('request/list/group/{group}', [GroupController::class, 'userRequestList'])->name('groups.requestUserList');

//UserGroup
    Route::resource('userGroup', UserGroupController::class);
    Route::get('group/user/list/{id}', [UserGroupController::class, 'groupUser'])->name('userGroup.groupUser');

});

require __DIR__.'/auth.php';
