@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-right mb-3">
        <div class="btn-group" role="group" aria-label="Basic example">
            @if (Auth::user()->is_admin)
                <form id="changeRole" action="{{ route('users.makeAdmin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    @if ($user->is_admin)
                        <button type="submit" class="btn btn-primary changeRole">Make User</button>
                    @else
                        <button type="submit" class="btn btn-primary changeRole">Make Admin</button>
                    @endif

                </form>
            @endif
            @if (Auth::user()->id == $user->id)
                <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-success">Edit</a>
            @endif
        </div>
    </div>

    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <span for="">Name : </span>
                            <input type="text" class="form-control" disabled
                                value="{{ $user->firstname }} {{ $user->lastname }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Student ID : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->student_id }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Number : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->phone }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Department : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->department }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Email : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->email }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Trimester No : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->trimester_no }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Section ID : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->section->name }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Major : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->major }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Skills : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->skills }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Achievements : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->achievements }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Other Contact Info : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->other_contact_info }}">
                        </div>
                        <div class="mb-2">
                            <span for="">Status : </span>
                            <input type="text" class="form-control" disabled value="{{ $user->status }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.changeRole').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#changeRole').submit();
                }
            });
        });
    </script>
@endpush
