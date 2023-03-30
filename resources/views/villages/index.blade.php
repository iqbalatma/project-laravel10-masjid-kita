<x-dashboard.layout>
    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">KELURAHAN</h4>
                    </div>
                    <div class="card-body" style="padding-top: 0cm;">
                        <div class=" button mb-3">
                            <a href="#" class="btn icon icon-left btn-success"><i data-feather="plus-square"></i>
                                Add Data</a>
                        </div>
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark mb-1">
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
                                        <td class="text-bold-500">{{ $key + 1 }}</td>
                                        <td class="text-bold-500">{{ $row->name }}</td>
                                        <td class="text-bold-500">{{ $row->population }}</td>
                                        <td class="text-bold-500">{{ $row->postcode }}</td>
                                        <td class="text-bold-500">{{ $row->created_at }}</td>
                                        <td style="text-align: center;">
                                            <a href="#" class="btn icon btn-warning"><i
                                                    class="badge-circle badge-circle-light-secondary font-medium-1"
                                                    data-feather="edit"></i></a>
                                            <a href="#" class="btn icon btn-danger"><i
                                                    class="badge-circle badge-circle-light-secondary font-medium-1"
                                                    data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $villages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bordered table end -->
    </section>
</x-dashboard.layout>