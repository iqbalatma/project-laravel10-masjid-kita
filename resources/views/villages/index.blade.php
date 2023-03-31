<x-dashboard.layout>
    <!-- Bordered table start -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">All Data Kelurahan</h4>

            <!-- Button Add New Data  -->
            <div class="button-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Add New Villages
                </button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <!-- table  -->
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kelurahan</th>
                        <th>Populasi</th>
                        <th>Kode Pos</th>
                        <th>created_at</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($villages as $key => $row )
                    <tr>
                        <td class="text-bold-500">{{ $villages->firstItem() + $key}}</td>
                        <td class="text-bold-500">{{ $row->name }}</td>
                        <td class="text-bold-500">{{ $row->population }}</td>
                        <td class="text-bold-500">{{ $row->postcode }}</td>
                        <td class="text-bold-500">{{ $row->created_at }}</td>
                        <td align="left">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal"
                                data-bs-target="#modal-edit">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                <button type="button" class="btn btn-danger btn-delete" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete" style="margin-left: 10px">
                                    <i class="fa-solid fa-trash-can"></i> Delete
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $villages->withQueryString()->links() }}
        </div>
    </div>
    <!--table end -->
</x-dashboard.layout>