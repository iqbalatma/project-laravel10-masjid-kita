<x-dashboard.layout>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>
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
                        <th scope="col">Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $transactions->firstItem() + $key }}</td>
                        <td>{{ $transaction->mosque->name }}</td>
                        <td>{{ formatToRupiah($transaction->amount) }}</td>
                        <td>{{ ucwords($transaction->transaction_type->name) }}</td>
                        <td>
                            <span @class(['badge rounded-pill', 'bg-success'=> $transaction->method=='income', 'bg-danger'=> $transaction->method=='expense'])>{{ ucwords($transaction->method) }}</span>
                        </td>
                        <td>{{ $transaction->user->name }}</td>
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
