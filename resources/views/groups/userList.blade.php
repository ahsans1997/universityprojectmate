@extends('layouts.app')

@section('content')
    @foreach ($groupUsers as $groupUser)
        @if (Auth::user()->id == $groupUser->user_id)
            <div class="col-md-12 text-right mb-3">
                <form id="authUserGroupLeave" action="{{ route('userGroup.destroy', $groupUser->id) }}" method="POST" ">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $groupUser->user_id }}">
                        <input type="hidden" name="group_id" value="{{ $groupUser->group_id }}">
                        <button type="submit" class="btn btn-danger">Leave Group</button>
                    </form>
                </div>
     @endif
        @endforeach

        <div class="col-md-12">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Student ID</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Number</th>
                        <th class="text-center">Major</th>
                        <th class="text-center">Skills</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groupUsers as $groupUser)
                        <tr>
                            <td class="text-center">{{ $groupUser->user->firstname }} {{ $groupUser->user->lastname }}</td>
                            <td class="text-center">{{ $groupUser->user->email }}</td>
                            <td class="text-center">{{ $groupUser->user->student_id }}</td>
                            <td class="text-center">{{ $groupUser->user->department }}</td>
                            <td class="text-center">{{ $groupUser->user->phone }}</td>
                            <td class="text-center">{{ $groupUser->user->major }}</td>
                            <td class="text-center">{{ $groupUser->user->skills }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @if (Auth::user()->id == $group->user_id)
                                        <button type="button" class="btn btn-danger btn-sm userGroupDelete"
                                            data-id="{{ $groupUser->id }}">Delete</button>


                                        <!-- Delete Form -->
                                        <form id="deleteForm-{{ $groupUser->id }}"
                                            action="{{ route('userGroup.destroy', $groupUser->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="user_id" value="{{ $groupUser->user_id }}">
                                            <input type="hidden" name="group_id" value="{{ $groupUser->group_id }}">
                                        </form>
                                    @endif
                                    <a href="{{ route('users.show', $groupUser->user_id) }}" class="btn btn-info btn-sm">Info</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-danger text-center" colspan="50">No Group Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <a href="{{ route('sections.show', $group->section_id) }}" class="btn btn-info">Back</a>
        </div>
    @endsection

    @push('scripts')
        <script>
            $('.userGroupDelete').on('click', function() {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let userGroupId = $(this).data('id');

                        $('#deleteForm-' + userGroupId).submit();

                    }
                });
            });

            $('#authUserGroupLeave').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, leave it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#authUserGroupLeave').submit();
                    }
                });
            });
        </script>
    @endpush
