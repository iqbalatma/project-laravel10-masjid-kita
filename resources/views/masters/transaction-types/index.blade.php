<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>

            @can($accessPermissions["TRANSACTION_TYPE_STORE"])
            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambahkan Tipe Transaksi Baru
                </button>
            </div>
            @endcan

        </div>
        <div class="card-body table-responsive">
            @if ($transactionTypes->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Terakhir Diperbaharui</th>
                        @canany([$accessPermissions["TRANSACTION_TYPE_UPDATE"],$accessPermissions["TRANSACTION_TYPE_DESTROY"]])
                        <th scope="col">Aksi</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactionTypes as $key => $type)
                    <tr>
                        <td>{{ $transactionTypes->firstItem() + $key }}</td>
                        <td>{{ ucwords($type->name) }}</td>
                        <td>{{ $type->updated_at }}</td>
                        @canany([$accessPermissions["TRANSACTION_TYPE_UPDATE"],$accessPermissions["TRANSACTION_TYPE_DESTROY"]])
                        <td>
                            @can($accessPermissions["TRANSACTION_TYPE_UPDATE"])
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-transaction-type="{{ $type }}">
                                <i class="fa-solid fa-pen-to-square"></i> Sunting
                            </button>
                            @endcan

                            @can($accessPermissions["TRANSACTION_TYPE_DESTROY"])
                            <button type="button" class="btn btn-danger btn-delete" data-id="{{ $type->id }}">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                            @endcan
                        </td>
                        @endcanany

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transactionTypes->withQueryString()->links() }}
            @endif
        </div>
    </div>

    @can($accessPermissions["TRANSACTION_TYPE_UPDATE"])
    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Sunting Tipe Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('masters.transaction.types.update', ':id') }}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Tipe Transaksi</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" form="form-edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @endcan


    @can($accessPermissions["TRANSACTION_TYPE_STORE"])
    <!-- Modal Add New Transaction Type-->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('masters.transaction.types.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Tipe Transaksi</label>
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
    @endcan

    @can($accessPermissions["TRANSACTION_TYPE_DESTROY"])
    <form id="form-delete" action="{{ route('masters.transaction.types.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>
    @endcan

    @push("scripts")
    @vite("resources/js/pages/masters/transaction-types/index.js")
    @endpush
</x-dashboard.layout>
