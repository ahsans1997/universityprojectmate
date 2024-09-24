@extends('layouts.app')

@section('content')
    @if (Auth::user()->is_admin)
        <div class="col-md-12 text-right mb-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createSectionModal">
                Create Section
            </button>
        </div>
    @endif

    <div class="col-md-12">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    @if (Auth::user()->is_admin)
                        <th class="text-center">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->code }}</td>
                        <td class="text-wrap "><a href="{{ route('sections.show', $section->id) }}"
                                style="color: #000">{{ $section->name }}</a></td>
                        @if (Auth::user()->is_admin)
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success btn-sm sectionEdit"
                                        data-id="{{ $section->id }}">Edit</button>

                                    <button type="button" class="btn btn-danger btn-sm sectionDelete"
                                        data-id="{{ $section->id }}">Delete</button>
                                    <!-- Delete Form -->
                                    <form id="deleteForm-{{ $section->id }}"
                                        action="{{ route('sections.destroy', $section->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createSectionModal" tabindex="-1" role="dialog" aria-labelledby="createSectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSectionModalLabel">Create Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('sections.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="editSectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSectionModalLabel">Update Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editSectionForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="ecode" name="code" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="ename" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Section</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.sectionEdit').on('click', function() {
            let sectionId = $(this).data('id');

            $.ajax({
                url: '{{ route('sections.edit', ':id') }}'.replace(':id', sectionId),
                type: 'GET',
                success: function(response) {
                    $('#ecode').val(response.code);
                    $('#ename').val(response.name);

                    $('#editSectionForm').attr('action', '{{ route('sections.update', ':id') }}'
                        .replace(':id', sectionId));

                    $('#editSectionModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('.sectionDelete').on('click', function() {
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
                    let sectionId = $(this).data('id');

                    $('#deleteForm-' + sectionId).submit();

                }
            });
        });
    </script>
@endpush
