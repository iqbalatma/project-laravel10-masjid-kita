<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data All Subdistrict</h4>

            @can($accessPermissions["SUBDISTRICT_STORE"])
            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Data Kecamatan
                </button>
            </div>
            @endcan

        </div>
        <div class="card-body table-responsive">
            @if ($subdistricts->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kabupaten</th>
                        <th scope="col">Created At</th>
                        @canany([$accessPermissions["SUBDISTRICT_UPDATE"], $accessPermissions["SUBDISTRICT_DESTROY"]])
                        <th scope="col">Action</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subdistricts as $key => $subdistrict)
                    <tr>
                        <td>{{ $subdistricts->firstItem() + $key }}</td>
                        <td>{{ $subdistrict->code }}</td>
                        <td>{{ ucwords($subdistrict->name) }}</td>
                        <td>{{ ucwords($subdistrict->district?->name ?? "-") }}</td>
                        <td>{{ $subdistrict->created_at }}</td>
                        @canany([$accessPermissions["SUBDISTRICT_UPDATE"], $accessPermissions["SUBDISTRICT_DESTROY"]])
                        <td>
                            @can($accessPermissions["SUBDISTRICT_UPDATE"])
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-subdistrict="{{ $subdistrict }}">
                                <i class="fa-solid fa-pen-to-square"></i> Sunting
                            </button>
                            @endcan

                            @can($accessPermissions["SUBDISTRICT_DESTROY"])
                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $subdistrict->id }}">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                            @endcan
                        </td>
                        @endcanany

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $subdistricts->withQueryString()->links() }}
            @endif
        </div>
    </div>

    @can($accessPermissions["SUBDISTRICT_UPDATE"])
    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Sunting Kecamatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.subdistricts.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12">
                            <label for="edit-district" class="form-label">Kabupaten</label>
                            <select id="edit-district" class="form-select" name="district_id">
                                <option selected>Pilih Kabupaten</option>
                                @foreach($districts as $key => $district)
                                <option value="{{ $district->id }}">{{ ucwords($district->name) }}</option>
                                @endforeach
                            </select>
                        </div>
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
    @endcan

    @can($accessPermissions["SUBDISTRICT_STORE"])
    <!-- Modal Add New Subdistrict-->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kecamatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.subdistricts.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-district" class="form-label">Kabupaten</label>
                            <select id="add-district" class="form-select" name="district_id">
                                <option selected>Pilih Kabupaten</option>
                                @foreach($districts as $key => $district)
                                <option value="{{ $district->id }}">{{ ucwords($district->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Kode Kecamatan</label>
                            <input type="text" class="form-control" id="add-code" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Nama Kecamatan</label>
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
    @endcan

    @can($accessPermissions["SUBDISTRICT_DESTROY"])
    <form id="form-delete" action="{{ route('masters.subdistricts.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>
    @endcan

    @push("scripts")
    @vite("resources/js/pages/masters/subdistricts/index.js")
    @endpush
</x-dashboard.layout>
