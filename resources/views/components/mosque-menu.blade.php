@canany([$accessPermissions["MOSQUE_TRANSACTION_INDEX"], $accessPermissions["MOSQUE_TRANSACTION_APPROVAL"]])
<li class="sidebar-title">Transaksi Masjid</li>

@forelse ($mosqueMenus as $key => $mosque)
<li class="sidebar-item  has-sub">
    <a href="#" class='sidebar-link'>
        <i class="fa-solid fa-mosque"></i>
        <span>{{ $mosque->name }}</span>
    </a>
    <ul class="submenu ">
        @can($accessPermissions["MOSQUE_TRANSACTION_INDEX"])
        <li class="submenu-item ">
            <a href="{{ route('mosque.transactions.index',['mosque_id' => $mosque->id, 'type'=> 'all']) }}">Transaksi</a>
        </li>
        @endcan

        @can($accessPermissions["MOSQUE_TRANSACTION_APPROVAL"])
        <li class="submenu-item">
            <a href="{{ route('mosque.transactions.index',['mosque_id' => $mosque->id, 'type'=> 'submissions']) }}">Pengajuan</a>
        </li>
        @endcan
    </ul>
</li>

@empty
<li class="sidebar-item">
    <p class='sidebar-link'>No Mosque</p>
</li>
@endforelse

@endcanany
