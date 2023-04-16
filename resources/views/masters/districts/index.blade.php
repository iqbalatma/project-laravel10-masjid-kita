<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Semua Data Kabupaten</h4>

            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambahkan Kabupaten Baru
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            @if ($districts->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Waktu Ditambahkan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($districts as $key => $district)
                    <tr>
                        <td>{{ $districts->firstItem() + $key }}</td>
                        <td>{{ $district->code }}</td>
                        <td>{{ ucwords($district->name) }}</td>
                        <td>{{ $district->created_at }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-district="{{ $district }}">
                                <i class="fa-solid fa-pen-to-square"></i> Sunting
                            </button>

                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $district->id }}">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $districts->withQueryString()->links() }}
            @endif
        </div>
    </div>

    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Sunting Kabupaten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.districts.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="district_id" value="1">
                        <div class="col-md-12">
                            <label for="edit-code" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="edit-code" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Nama</label>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kabupaten Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.districts.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Kode Kabupaten</label>
                            <input type="text" class="form-control" id="add-code" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Nama Kabupaten</label>
                            <input type="text" class="form-control" id="add-name" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="form-add" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <form id="form-delete" action="{{ route('masters.subdistricts.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>

    @push("scripts")
    @vite("resources/js/pages/masters/districts/index.js")
    @endpush
</x-dashboard.layout>