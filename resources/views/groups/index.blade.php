@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-right mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createGroupModal">
            Create Group
        </button>
    </div>

    <div class="col-md-12">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Section Name</th>
                    <th>User Limit</th>
                    <th>Author</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sectionGroups as $sectionGroup)
                    <tr>
                        <td class="text-wrap "><a href="{{ route('userGroup.groupUser', $sectionGroup->id) }}"
                                style="color: #000">{{ $sectionGroup->name }}</a></td>
                        <td>{{ $sectionGroup->section->name }}</td>
                        <td>{{ $sectionGroup->max_users }}</td>
                        <td>{{ $sectionGroup->user->firstname }} {{ $sectionGroup->user->lastname }}</td>
                        @if (Auth::user()->id == $sectionGroup->user_id)
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success btn-sm sectionGroupEdit"
                                        data-id="{{ $sectionGroup->id }}">Edit</button>
                                    <a href="{{ route('groups.requestUserList', $sectionGroup->id) }}"
                                        class="btn btn-info btn-sm">Request for Join List</a>
                                    <button type="button" class="btn btn-danger btn-sm sectionGroupDelete"
                                        data-id="{{ $sectionGroup->id }}">Delete</button>


                                    <!-- Delete Form -->
                                    <form id="deleteForm-{{ $sectionGroup->id }}"
                                        action="{{ route('groups.destroy', $sectionGroup->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        @else
                            <td class="text-center">
                                <a href="{{ route('groups.join', $sectionGroup->id) }}" class="btn btn-info btn-sm">Request
                                    for Join</a>
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
        <a href="{{ route('sections.index') }}" class="btn btn-info">Back</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGroupModalLabel">Create New Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('groups.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div>
                            <label for="name">User Limit</label>
                            <input type="number" name="max_users" id="name" class="form-control" required>
                        </div>
                        <input type="hidden" name="section_id" value="{{ $sectionInfo->id }}">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Gropu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Update Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" id="ename" class="form-control" required>
                        </div>
                        <div>
                            <label for="name">User Limit</label>
                            <input type="number" name="max_users" id="emax_user" class="form-control" required>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Gropu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.sectionGroupEdit').on('click', function() {
            let sectionGroupId = $(this).data('id');

            $.ajax({
                url: '{{ route('groups.edit', ':id') }}'.replace(':id', sectionGroupId),
                type: 'GET',
                success: function(response) {
                    $('#ename').val(response.name);
                    $('#emax_user').val(response.max_users);

                    $('#editGroupForm').attr('action', '{{ route('groups.update', ':id') }}'
                        .replace(':id', sectionGroupId));

                    $('#editGroupModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('.sectionGroupDelete').on('click', function() {
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
                    let sectionGroupId = $(this).data('id');

                    $('#deleteForm-' + sectionGroupId).submit();

                }
            });
        });
    </script>
@endpush
