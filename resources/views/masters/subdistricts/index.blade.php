<x-dashboard.layout>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data All Subdistrict</h4>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</x-dashboard.layout>