<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data All Subdistrict</h4>

            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Add New Subdistrict
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            @if ($subdistricts->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">District</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subdistricts as $key => $subdistrict)
                    <tr>
                        <td>{{ $subdistricts->firstItem() + $key }}</td>
                        <td>{{ $subdistrict->code }}</td>
                        <td>{{ ucwords($subdistrict->name) }}</td>
                        <td>{{ ucwords("nama kabupaten") }}</td>
                        <td>{{ $subdistrict->created_at }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-subdistrict="{{ $subdistrict }}">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $subdistricts->withQueryString()->links() }}
            @endif
        </div>
    </div>

    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Edit Subdistrict</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.subdistricts.update', ':id') }}">
                        @csrf
                        @method("PATCH")
                        <input type="hidden" name="district_id" value="1">
                        <div class="col-md-12">
                            <label for="edit-code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="edit-code" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-edit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add New Subdistrict-->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Subdistrict</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.subdistricts.store') }}">
                        @csrf
                        {{-- //TODO - select option for parent (district) --}}
                        <input type="hidden" name="district_id" value="1">
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="add-code" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add-name" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-add" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    @push("scripts")
    @vite("resources/js/pages/masters/subdistricts/index.js")
    @endpush
</x-dashboard.layout>