@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Student ID</th>
                    <th class="text-center">Department</th>
                    <th class="text-center">Number</th>
                    <th class="text-center">Section Code</th>
                    <th class="text-center">Major</th>
                    <th class="text-center">Skills</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->student_id }}</td>
                        <td class="text-center">{{ $user->department }}</td>
                        <td class="text-center">{{ $user->phone }}</td>
                        <td class="text-center">{{ $user->section->code }}</td>
                        <td class="text-center">{{ $user->major }}</td>
                        <td class="text-center">{{ $user->skills }}</td>
                        <td class="text-center">
                            @if ($user->status == 0)
                                individual
                            @else
                                grouped
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Info</a>
                                <button type="button" class="btn btn-danger btn-sm userDelete"
                                    data-id="{{ $user->id }}">Delete</button>
                                <!-- Delete Form -->
                                <form id="deleteForm-{{ $user->id }}"
                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                    style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $('.userDelete').on('click', function() {
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
                    let userID = $(this).data('id');

                    $('#deleteForm-' + userID).submit();

                }
            });
        });
    </script>
@endpush
