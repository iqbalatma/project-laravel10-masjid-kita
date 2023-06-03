<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="dropdown ms-auto">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ \Illuminate\Support\Facades\Auth::user()->name ?? "Guest" }}</h6>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\URL::to("/images/" . str_replace("/", "_", \Illuminate\Support\Facades\Auth::user()->profile_image)) }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </a>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem;">
                            <li>
                                <h6 class="dropdown-header">
                                    Hello, {{\Illuminate\Support\Facades\Auth::user()->name ?? "Guest"}}</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{route("profile.edit")}}"><i
                                        class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{route("auth.logout")}}"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                        </ul>
                    @else
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem;">
                            <li>
                                <h6 class="dropdown-header">
                                    Hello, {{\Illuminate\Support\Facades\Auth::user()->name ?? "Guest"}}</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{route("auth.login")}}"><i
                                        class="icon-mid bi bi-person me-2"></i> Login</a></li>
                        </ul>
                    @endif
                </div>

                {{--                <a href="{{route("profile.edit")}}">--}}
                {{--                    <div class="user-menu d-flex">--}}
                {{--                        <div class="user-name text-end me-3">--}}
                {{--                            <h6 class="mb-0 text-gray-600">{{ \Illuminate\Support\Facades\Auth::user()->name ?? "Guest" }}</h6>--}}
                {{--                        </div>--}}
                {{--                        @if(\Illuminate\Support\Facades\Auth::check())--}}
                {{--                            <div class="user-img d-flex align-items-center">--}}
                {{--                                <div class="avatar avatar-md">--}}
                {{--                                    <img--}}
                {{--                                        src="{{ \Illuminate\Support\Facades\URL::to("/images/" . str_replace("/", "_", \Illuminate\Support\Facades\Auth::user()->profile_image)) }}">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        @endif--}}
                {{--                    </div>--}}
                {{--                </a>--}}
            </div>
        </div>
    </nav>
</header>
