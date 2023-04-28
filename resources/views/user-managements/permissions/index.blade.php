<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-user-tag"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            @if ($permissions->count()==0)
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
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $permissions->firstItem()+$key }}</td>
                            <td>{{ $permission->name}}</td>
                            <td>{{ ucwords($permission->guard_name) }}</td>
                            <td>{{ $permission->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permissions->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>
</x-dashboard.layout>
