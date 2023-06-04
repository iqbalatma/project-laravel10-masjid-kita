<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>
            @can($accessPermissions["MOSQUE_TRANSACTION_STORE"])
            <div class="button-group">
                <!-- Button Add New Data  -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Tambahkan Transaksi Baru
                </button>
            </div>
            @endcan
        </div>
        <div class="card-body table-responsive">
            @if ($transactions->count() == 0)
            <x-empty-data></x-empty-data>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Masjid</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Aktor Pelaksana</th>
                        <th scope="col">Status Pengajuan</th>
                        <th scope="col">Tanggal Persetujuan</th>
                        <th scope="col">Tanggal Transaksi</th>
                        @if(request()->route('type')=='submissions')
                        @can($accessPermissions["MOSQUE_TRANSACTION_APPROVAL"])
                        <th scope="col">Action</th>
                        @endcan
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $transactions->firstItem() + $key }}</td>
                        <td>{{ $transaction->mosque?->name }}</td>
                        <td>{{ formatToRupiah($transaction->amount) }}</td>
                        <td>{{ ucwords($transaction->transaction_type->name) }}</td>
                        <td>
                            <span @class(['badge rounded-pill', 'bg-success'=> $transaction->method=='income', 'bg-danger'=> $transaction->method=='expense'])>{{ ucwords($transaction->method) }}</span>
                        </td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>
                            <span @class(['badge rounded-pill', 'bg-success'=> $transaction->status=='approved', 'bg-danger'=> $transaction->status=='rejected', 'bg-warning' => $transaction->status == 'pending'])>{{ ucwords($transaction->status) }}</span>
                        </td>

                        <td>{{ $transaction->status_change_at }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        @if(request()->route('type')=='submissions')
                        @can($accessPermissions["MOSQUE_TRANSACTION_APPROVAL"])
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-approval" data-bs-toggle="modal" data-bs-target="#modal-approval" data-transaction="{{ $transaction }}">
                                <i class="fa-solid fa-pen-to-square"></i> Persetujuan
                            </button>
                        </td>
                        @endcan
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $transactions->withQueryString()->links() }}
            @endif
        </div>
    </div>


    @can($accessPermissions["MOSQUE_TRANSACTION_STORE"])
    <!-- Modal Add New -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('mosque.transactions.store', request()->route('mosque_id')) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-amount" class="form-label">Jumlah Transaksi</label>
                            <input type="number" min="0" class="form-control" id="add-amount" name="amount">
                        </div>
                        <div class="col-md-12">
                            <label for="add-transaction-type" class="form-label">Tipe Transaksi</label>
                            <select id="add-transaction-type" name="transaction_type_id" class="form-select">
                                <option selected disabled>Pilih Tipe Transaksi</option>
                                @foreach ($transactionTypes as $type)
                                <option value="{{ $type->id }}">{{ ucwords($type->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="add-method" class="form-label">Metode</label>
                            <select id="add-method" name="method" class="form-select">
                                <option selected disabled>Pilih Metode</option>
                                <option value="expense">Pengeluaran</option>
                                <option value="income">Pemasukan</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="add-description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="add-description" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="transaction_images[]" class="form-label">Bukti Transaksi</label>
                            <input class="form-control" type="file" id="transaction_images[]" name="transaction_images[]" multiple>
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

    @can($accessPermissions["MOSQUE_TRANSACTION_APPROVAL"])
    <!-- Modal Edit -->
    <div class=" modal fade" id="modal-approval" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-editLabel">Persetujuan Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-approval" class="row g-3" method="POST" action="{{ route('mosque.transactions.approval',['mosque_id'=> request()->route('mosque_id'), 'id'=> ':id']) }}">
                        @csrf
                        @method("PUT")
                        <div class="col-md-12">
                            <label for="approval-status" class="form-label">Status</label>
                            <select id="approval-status" class="form-select" name="status">
                                <option selected>Pilih Status</option>
                                <option value="rejected">Reject</option>
                                <option value="approved">Approve</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form-approval" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @push("scripts")
    @vite("resources/js/pages/mosques/transactions/index.js")
    @endpush
</x-dashboard.layout>
