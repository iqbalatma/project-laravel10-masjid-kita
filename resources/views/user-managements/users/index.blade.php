<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-users-gear"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @can($userManagementPermissions::STORE)
            {{-- Button Add New User --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
                <i class="fa-solid fa-plus"></i>
                Tambah User
            </button>
            @endcan


            @if ($users->count()==0)
            <x-empty-data></x-empty-data>
            @else
            {{-- Table Users --}}
            <div class="table-responsive mt-4">
                <table class="table align-middle">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Roles</th>
                        <th>Email Verified At</th>
                        <th>Last Updated Time</th>
                        @canany([$userManagementPermissions::UPDATE,$userManagementPermissions::CHANGE_STATUS_ACTIVE])
                        <th>Action</th>
                        @endcanany
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem()+$key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone??"-" }}</td>
                            <td>{{ $user->address??"-" }}</td>
                            <td><span @class(["badge","bg-success"=> $user->status=="active", "bg-danger" => $user->status=="inactive" ])>{{ ucwords($user->status) }}</span></td>
                            <td>
                                @foreach($user->roles as $key => $role)
                                <span class="badge bg-primary">{{ ucwords($role->name) }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if (!$user->email_verified_at)
                                <span class="badge bg-warning">Not Verified</span>
                                @else
                                {{ $user->email_verified_at }}
                                @endif
                            </td>
                            <td>{{ $user->updated_at }}</td>
                            @canany([$userManagementPermissions::UPDATE,$userManagementPermissions::CHANGE_STATUS_ACTIVE])
                            <td>
                                <div class="d-grid gap-2 d-md-flex">
                                    @can($userManagementPermissions::UPDATE)
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#modal-edit" data-user="{{ $user }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Sunting
                                    </button>
                                    @endcan

                                    @can($userManagementPermissions::CHANGE_STATUS_ACTIVE)
                                    <form action="{{ route('user.managements.users.change.status.active', $user->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        @if ($user->status=="active")
                                        <button type="submit" class="btn btn-sm btn-danger btn-change-status">
                                            Nonaktifkan <i class="fa-solid fa-x"></i>
                                        </button>
                                        @else
                                        <button type="submit" class="btn btn-sm btn-primary btn-change-status">
                                            Aktifkan <i class="fa-solid fa-square-check"></i>
                                        </button>
                                        @endif
                                    </form>
                                    @endcan
                                </div>
                            </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>

    @can($userManagementPermissions::STORE)
    <!-- Modal Add New Users -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" class="row g-3" method="POST" action="{{ route('user.managements.users.store') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="add-name" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="add-name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="add-email" class="form-label">Email User</label>
                            <input type="email" class="form-control" id="add-email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="add-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="add-password" name="password">
                        </div>
                        <div class="col-md-12">
                            <label for="add-password-confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="add-password-confirmation" name="password_confirmation">
                        </div>
                        <div class="col-md-12">
                            <label for="add-phone" class="form-label">Nomor Telepon User</label>
                            <input type="text" class="form-control" id="add-phone" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-12">
                            <label for="add-address" class="form-label">Address</label>
                            <textarea class="form-control" id="add-address" name="address" rows="4" placeholder="Enter your address">{{old('address')}}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="add-roles" class="form-label">Roles</label><br>
                            @foreach ($roles as $key=> $role)
                            <div class="form-check form-switch form-check-inline">
                                <input name="roles[]" class="form-check-input" type="checkbox" id="add-roles-{{ $role->id }}" value="{{ $role->id }}">
                                <label class="form-check-label" for="add-roles-{{ $role->id }}">{{ ucwords($role->name) }}</label>
                            </div>
                            @endforeach
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

    @can($userManagementPermissions::UPDATE)
    <!-- Modal Edit Users -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="modal-addLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" class="row g-3" method="POST" action="{{ route('user.managements.users.update', ':id') }}">
                        @csrf
                        @method("PATCH")
                        <div class="col-md-12">
                            <label for="edit-name" class="form-label">Nama User</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-email" class="form-label">Email User</label>
                            <input type="email" class="form-control" id="edit-email" name="email" readonly disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="edit-password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="edit-password" name="password">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-password-confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="edit-password-confirmation" name="password_confirmation">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-phone" class="form-label">Nomor Telepon User</label>
                            <input type="text" class="form-control" id="edit-phone" name="phone">
                        </div>
                        <div class="col-md-12">
                            <label for="edit-address" class="form-label">Address</label>
                            <textarea class="form-control" id="edit-address" name="address" rows="4" placeholder="Enter your address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="edit-roles" class="form-label">Roles</label><br>
                            @foreach ($roles as $key=> $role)
                            <div class="form-check form-switch form-check-inline">
                                <input name="roles[]" class="form-check-input" type="checkbox" id="edit-roles-{{ $role->id }}" value="{{ $role->id }}">
                                <label class="form-check-label" for="edit-roles-{{ $role->id }}">{{ ucwords($role->name) }}</label>
                            </div>
                            @endforeach
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


    @push('scripts')
    @vite("resources/js/pages/user-managements/users/index.js")
    @endpush

</x-dashboard.layout>
