@canany([$mosqueTransactionPermissions::INDEX, $mosqueTransactionPermissions::APPROVAL])
<li class="sidebar-title">Transaksi Masjid</li>

@forelse ($mosqueMenus as $key => $mosque)
<li class="sidebar-item  has-sub">
    <a href="#" class='sidebar-link'>
        <i class="fa-solid fa-mosque"></i>
        <span>{{ $mosque->name }}</span>
    </a>
    <ul class="submenu ">
        @can($transactionPermissions::INDEX)
        <li class="submenu-item ">
            <a href="{{ route('mosque.transactions.index',['mosque_id' => $mosque->id, 'type'=> 'all']) }}">Transaksi</a>
        </li>
        @endcan

        @can($mosqueTransactionPermissions::APPROVAL)
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