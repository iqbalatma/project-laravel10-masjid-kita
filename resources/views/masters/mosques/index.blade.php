<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>

            @can($mosquePermissions::STORE)
            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambahkan Masjid Baru
                </button>
            </div>
            @endcan

        </div>
        <div class="card-body table-responsive">
            @if ($mosques->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">Luas Wilayah</th>
                        <th scope="col">Terakhir Diperbaharui</th>
                        @canany([$mosquePermissions::UPDATE,$mosquePermissions::DESTROY])
                        <th scope="col">Aksi</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mosques as $key => $mosque)
                    <tr>
                        <td>{{ $mosques->firstItem() + $key }}</td>
                        <td>{{ ucwords($mosque->name) }}</td>
                        <td>{{ $mosque->latitude }}</td>
                        <td>{{ $mosque->longitude }}</td>
                        <td>{{ $mosque->area_wide }} m<sup>2</sup></td>
                        <td>{{ $mosque->updated_at }}</td>
                        @canany([$mosquePermissions::UPDATE,$mosquePermissions::DESTROY])
                        <td>
                            @can($districtPermissions::UPDATE)
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-mosque="{{ $mosque }}">
                                <i class="fa-solid fa-pen-to-square"></i> Sunting
                            </button>
                            @endcan

                            @can($mosquePermissions::DESTROY)
                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $mosque->id }}">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                            @endcan
                        </td>
                        @endcanany

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mosques->withQueryString()->links() }}
            @endif
        </div>
    </div>

    @can($mosquePermissions::UPDATE)
    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Sunting Masjid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.mosques.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Nama Masjid</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="edit-latitude" name="latitude">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="edit-longitude" name="longitude">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-village" class="form-label">Desa/Kelurahan</label>
                            <select id="edit-village" class="form-select" name="village_id">
                                <option selected>Pilih Desa/Kelurahan</option>
                                @foreach($villages as $key => $village)
                                <option value="{{ $village->id }}">{{ ucwords($village->name) }}</option>
                                @endforeach
                            </select>
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


    @can($mosquePermissions::STORE)
    <!-- Modal Add New Mosque-->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Masjid Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.mosques.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Nama Masjid</label>
                            <input type="text" class="form-control" id="add-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="add-latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="add-latitude" name="latitude">
                        </div>
                        <div class="col-md-12">
                            <label for="add-longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="add-longitude" name="longitude">
                        </div>
                        <div class="col-md-12">
                            <label for="add-village" class="form-label">Desa/Kelurahan</label>
                            <select id="add-village" class="form-select" name="village_id">
                                <option selected>Pilih Desa/Kelurahan</option>
                                @foreach($villages as $key => $village)
                                <option value="{{ $village->id }}">{{ ucwords($village->name) }}</option>
                                @endforeach
                            </select>
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
    @endcan

    @can($mosquePermissions::DESTROY)
    <form id="form-delete" action="{{ route('masters.mosques.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>
    @endcan

    @push("scripts")
    @vite("resources/js/pages/masters/mosques/index.js")
    @endpush
</x-dashboard.layout>
