<div class="col-12 col-md-6 order-md-2 order-first">
    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
        <ol class="breadcrumb">
            @foreach ($breadcumbs as $key => $breadcumb)
            @if ($key == $lastBreadcumbKey)
            <li class="breadcrumb-item active">
                {{ ucwords($key) }}
            </li>
            @else
            <li class="breadcrumb-item">
                <a href="{{ $breadcumb }}">{{ ucwords($key) }}</a>
            </li>
            @endif
            @endforeach
        </ol>
    </nav>
</div>