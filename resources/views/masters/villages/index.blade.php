<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data All Villages</h4>

            @can($villagePermissions::STORE)
            <!-- Button Add New Data  -->
            <div class="button-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Add New Villages
                </button>
            </div>
            @endcan

        </div>
        <div class="card-body table-responsive">
            @if ($villages->count() == 0)
            <x-empty-data></x-empty-data>
            @else

            <!-- table  -->
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kode Post</th>
                        <th>Kecamatan</th>
                        <th>Terakhir Diperbaharui</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($villages as $key => $row )
                    <tr>
                        <td class="text-bold-500">{{ $villages->firstItem() + $key}}</td>
                        <td class="text-bold-500">{{ $row->name }}</td>
                        <td class="text-bold-500">{{ $row->postcode }}</td>
                        <td class="text-bold-500">{{ ucwords($row->subdistrict?->name)??"-" }}</td>
                        <td class="text-bold-500">{{ $row->updated_at }}</td>
                        <td align="left">
                            @can($villagePermissions::UPDATE)
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            @endcan

                            <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#modal-delete" style="margin-left: 10px">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $villages->withQueryString()->links() }}
            @endif
        </div>
    </div>

    @can($villagePermissions::STORE)
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
                            <label for="edit-district" class="form-label">Kecamatan</label>
                            <select id="edit-district" class="form-select" name="subdistrict_id">
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

</x-dashboard.layout>
