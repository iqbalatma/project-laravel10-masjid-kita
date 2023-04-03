<x-dashboard.layout>
    <!-- Bordered table start -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data All Villages</h4>

            <!-- Button Add New Data  -->
            <div class="button-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                    <i class="fa-solid fa-plus"></i>
                    Add New Villages
                </button>
            </div>
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
            @endif
        </div>
    </div>
    <!--table end -->

    <!-- modal add new village -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Village</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="">
                        @csrf
                        {{-- //TODO - select option for parent (district) --}}
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Nama Kelurahan</label>
                            <input type="text" class="form-control" id="add-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Populasi</label>
                            <input type="text" class="form-control" id="add-population" name="code">
                        </div>
                        <div class="col-md-12">
                            <label for="add-code" class="form-label">Kode Pos</label>
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

</x-dashboard.layout>