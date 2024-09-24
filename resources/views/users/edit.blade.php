@extends('layouts.app')

@section('content')
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <span for="">First Name : </span>
                                <input type="text" class="form-control" name="firstname"
                                    value="{{ $user->firstname }} {{ $user->lastname }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Last Name : </span>
                                <input type="text" class="form-control" name="lastname"
                                    value="{{ $user->firstname }} {{ $user->lastname }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Student ID : </span>
                                <input type="text" class="form-control" name="student_id"
                                    value="{{ $user->student_id }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Number : </span>
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Department : </span>
                                <input type="text" class="form-control" name="department"
                                    value="{{ $user->department }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Trimester No : </span>
                                <input type="text" class="form-control" name="trimester_no"
                                    value="{{ $user->trimester_no }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Section ID : </span>
                                <select name="section_id" id="" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach ($sections as $section)

                                        <option value="{{ $section->id }}" {{ ($user->section_id == $section->id) ? 'selected' : '' }}>{{ $section->code }} -
                                            {{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <span for="">Major : </span>
                                <input type="text" class="form-control" name="major" value="{{ $user->major }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Skills : </span>
                                <input type="text" class="form-control" name="skills" value="{{ $user->skills }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Achievements : </span>
                                <input type="text" class="form-control" name="achievements"
                                    value="{{ $user->achievements }}">
                            </div>
                            <div class="mb-2">
                                <span for="">Other Contact Info : </span>
                                <input type="text" class="form-control" name="other_contact_info"
                                    value="{{ $user->other_contact_info }}">
                            </div>
                            <button type="submit" class="btn btn-success" style="float: right">Update Info</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
