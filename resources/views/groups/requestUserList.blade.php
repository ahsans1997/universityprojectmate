@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Uset Name</th>
                <th>Group Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requestUserList as $list)
                <tr>
                    <td>{{ $list->user->firstname }} {{ $list->user->lastname }}</td>
                    <td>{{ $list->group->name }}</td>
                    @if (Auth::user()->id == $group->user_id)
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <form action="{{ route('userGroup.update', $list->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="user_id" value="{{ $list->user_id }}">
                                    <input type="hidden" name="group_id" value="{{ $list->group_id }}">
                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                </form>
                                <button type="button" class="btn btn-danger btn-sm userGroupDelete" data-id="{{ $list->id }}">Delete</button>


                                <!-- Delete Form -->
                                <form id="deleteForm-{{ $list->id }}"
                                    action="{{ route('userGroup.destroy', $list->id) }}" method="POST"
                                    style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{ $list->user_id }}">
                                    <input type="hidden" name="group_id" value="{{ $list->group_id }}">
                                </form>
                            </div>
                        </td>
                    @endif
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

    </script>
@endpush
