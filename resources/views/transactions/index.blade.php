<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>
        </div>
        <div class="card-body table-responsive">
            <form class="row g-3 mb-4" id="form-filter" method="GET" action="{{route('transactions.index', 'all')}}">
                <div class="col-md-3">
                    <label for="mosque_name" class="form-label">Nama Masjid</label>
                    <input type="text" class="form-control" id="mosque_name" name="mosque_name">
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="filter[columns][1]" value="code">
                    <input type="hidden" name="filter[operators][1]" value="like">
                    <label for="code" class="form-label">Kode Transaksi</label>
                    <input type="text" class="form-control" id="code" name="filter[values][1]" value="{{request()->query('filter')['values'][1]??''}}">
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="filter[columns][2]" value="transaction_type_id">
                    <label for="transaction_type_id" class="form-label">Tipe</label>
                    <select id="transaction_type_id" class="form-select" name="filter[values][2]">
                        <option selected value>Tipe Transaksi</option>
                        @foreach($transactionTypes as $type)
                            <option value="{{$type->id}}" @if((request()->query('filter')['values'][2]??'') == $type->id) selected @endif>{{ ucwords($type->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="hidden" name="filter[columns][3]" value="method">
                    <label for="method" class="form-label">Metode</label>
                    <select id="method" class="form-select" name="filter[values][3]">
                        <option selected value>Metode Transaksi</option>
                        <option value="income"  @if((request()->query("filter")["values"][3]??'') === 'income') selected @endif>Income</option>
                        <option value="expense" @if((request()->query("filter")["values"][3]??'') === 'expense') selected @endif>Expense</option>
                    </select>
                </div>
                @if(request()->route("type")!== "submissions")
                <div class="col-md-3">
                    <input type="hidden" name="filter[columns][4]" value="status">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" class="form-select" name="filter[values][4]">
                        <option selected value>Status Pengajuan</option>
                        <option value="approved" @if((request()->query('filter')['values'][4]??'') === 'approved') selected @endif>Approved</option>
                        <option value="pending" @if((request()->query('filter')['values'][4]??'') === 'pending') selected @endif>Pending</option>
                        <option value="rejected" @if((request()->query('filter')['values'][4]??'') === 'rejected') selected @endif>Rejected</option>
                    </select>
                </div>
                @endif
            </form>
            <div class="row mb-4">
                <div class="col-md-3">
                    <a class="btn btn-secondary" href="{{route('transactions.index', 'all')}}">Reset</a>
                    <button class="btn btn-primary" form="form-filter" type="submit">Filter</button>
                </div>
            </div>

            @if ($transactions->count() == 0)
                <x-empty-data></x-empty-data>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Transaksi</th>
                        <th scope="col">Nama Masjid</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Metode</th>
                        <th scope="col">Aktor Pelaksana</th>
                        <th scope="col">Status Pengajuan</th>
                        <th scope="col">Perubahan Status Oleh</th>
                        <th scope="col">Tanggal Perubahan Status</th>
                        <th scope="col">Tanggal Transaksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transactions as $key => $transaction)
                        <tr>
                            <td>{{ $transactions->firstItem() + $key }}</td>
                            <td>{{ $transaction->code }}</td>
                            <td>{{ $transaction->mosque->name }}</td>
                            <td>{{ formatToRupiah($transaction->amount) }}</td>
                            <td>{{ ucwords($transaction->transaction_type->name) }}</td>
                            <td><span @class(['badge rounded-pill', 'bg-success'=> $transaction->method=='income', 'bg-danger'=> $transaction->method=='expense'])>{{ ucwords($transaction->method) }}</span></td>
                            <td>{{ $transaction->user->name }}</td>
                            <td><span @class(['badge rounded-pill', 'bg-success'=> $transaction->status=='approved', 'bg-danger'=> $transaction->status=='rejected', 'bg-warning' => $transaction->status == 'pending'])>{{ ucwords($transaction->status) }}</span></td>
                            <td>{{ $transaction->status_changer?->name ?? "-" }}</td>
                            <td>{{ $transaction->status_change_at }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $transactions->withQueryString()->links() }}
            @endif
        </div>
    </div>
</x-dashboard.layout>
