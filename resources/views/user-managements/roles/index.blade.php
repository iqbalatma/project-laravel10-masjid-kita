<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">{{ $cardTitle }}</h4>

            @can($accessPermissions["ROLE_INDEX"])
                <div class="button-group">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('user.managements.roles.create') }}" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-square-plus"></i>
                            Tambahkan Peran Baru
                        </a>
                    </div>
                </div>
            @endcan
        </div>
        <div class="card-body">
            @if ($roles->count()==0)
                <x-empty-data></x-empty-data>
            @else
                {{-- Table Data Roles --}}
                <div class="table-responsive mt-4">
                    <table class="table align-middle">
                        <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Last Updated Time</th>
                        @canany([$accessPermissions["ROLE_EDIT"], $accessPermissions["ROLE_DESTROY"]])
                            <th>Action</th>
                        @endcanany
                        </thead>
                        <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $roles->firstItem()+$key }}</td>
                                <td>{{ ucwords($role->name) }}</td>
                                <td>{{ ucwords($role->guard_name) }}</td>
                                <td>{{ $role->updated_at }}</td>
                                @canany([$accessPermissions["ROLE_EDIT"], $accessPermissions["ROLE_DESTROY"]])
                                    <td>
                                        @can($accessPermissions["ROLE_EDIT"])
                                            <a class="btn btn-success"
                                               href="{{ route('user.managements.roles.edit', $role->id) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan

                                        @can($accessPermissions["ROLE_DESTROY"])
                                            <button type="button" class="btn btn-danger btn-delete"
                                                    data-id="{{ $role->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endcan
                                    </td>
                                @endcanany

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>


    <form id="form-delete" action="{{ route('user.managements.roles.destroy', ':id') }}" class="d-none" method="POST">
        @csrf
        @method("DELETE")
    </form>

    @push("scripts")
        @vite("resources/js/pages/user-managements/roles/index.js")
    @endpush
</x-dashboard.layout>
