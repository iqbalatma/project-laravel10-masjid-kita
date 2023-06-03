<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data All Villages</h4>

            @can($accessPermission["VILLAGE_STORE"])
            <!-- Button Add New Data  -->
            <div class="button-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Desa/Kelurahan Baru
                </button>
            </div>
            @endcan

        </div>
        <div class="card-body table-responsive">
            @if ($villages->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kode Post</th>
                        <th>Kecamatan</th>
                        <th>Terakhir Diperbaharui</th>
                        @canany([$accessPermission["VILLAGE_UPDATE"], $accessPermission["VILLAGE_DESTROY"]])
                        <th>Action</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($villages as $key => $village )
                    <tr>
                        <td class="text-bold-500">{{ $villages->firstItem() + $key}}</td>
                        <td class="text-bold-500">{{ $village->name }}</td>
                        <td class="text-bold-500">{{ $village->postcode }}</td>
                        <td class="text-bold-500">{{ ucwords($village->subdistrict?->name)??"-" }}</td>
                        <td class="text-bold-500">{{ $village->updated_at }}</td>
                        @canany([$accessPermission["VILLAGE_UPDATE"], $accessPermission["VILLAGE_DESTROY"]])
                        <td align="left">
                            @can($accessPermission["VILLAGE_UPDATE"])
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-village="{{ $village }}">
                                <i class="fa-solid fa-pen-to-square"></i> Sunting
                            </button>
                            @endcan
                            @can($accessPermission["VILLAGE_DESTROY"])
                            <button type="button" class="btn btn-danger btn-delete" style="margin-left: 10px" data-id="{{ $village->id }}">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                            @endcan
                        </td>
                        @endcanany
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $villages->withQueryString()->links() }}
            @endif
        </div>
    </div>

    @can($accessPermission["VILLAGE_STORE"])
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Desa/Kelurahan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.villages.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-district" class="form-label">Kecamatan</label>
                            <select id="add-district" class="form-select" name="subdistrict_id">
                                <option selected>Pilih Kecamatan</option>
                                @foreach($subdistricts as $key => $subdistrict)
                                <option value="{{ $subdistrict->id }}">{{ ucwords($subdistrict->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="add-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Post Code</label>
                            <input type="text" class="form-control" id="add-postcode" name="postcode">
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

    @can($accessPermission["VILLAGE_UPDATE"])
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Desa/Kelurahan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.villages.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12">
                            <label for="edit-subdistrict" class="form-label">Kecamatan</label>
                            <select id="edit-subdistrict" class="form-select" name="subdistrict_id">
                                <option selected>Pilih Kecamatan</option>
                                @foreach($subdistricts as $key => $subdistrict)
                                <option value="{{ $subdistrict->id }}">{{ ucwords($subdistrict->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-code" class="form-label">Post Code</label>
                            <input type="text" class="form-control" id="edit-postcode" name="postcode">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-edit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can($accessPermission["VILLAGE_DESTROY"])
    <form id="form-delete" action="{{ route('masters.villages.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>
    @endcan

    @push("scripts")
    @vite("resources/js/pages/masters/villages/index.js")
    @endpush
</x-dashboard.layout>
