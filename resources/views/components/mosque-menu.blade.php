@canany([$transactionPermissions::INDEX])
<li class="sidebar-title">Transaksi Masjid</li>

@can($transactionPermissions::INDEX)
@forelse ($mosqueMenus as $key => $mosque)
<li class="sidebar-item">
    <a href="{{ route('mosque.transactions.index', $mosque->id) }}" class='sidebar-link'>
        <i class="fa-solid fa-mosque"></i>
        <span>{{ $mosque->name }}</span>
    </a>
</li>
@empty
<li class="sidebar-item">
    <p class='sidebar-link'>No Mosque</p>
</li>
@endforelse
@endcan

@endcanany
