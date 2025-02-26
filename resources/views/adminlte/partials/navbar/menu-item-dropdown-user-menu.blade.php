@php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))
@php($profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout'))

@if (config('adminlte.usermenu_profile_url', false))
    @php($profile_url = Auth::user()->adminlte_profile_url())
@endif

@if (config('adminlte.use_route_url', false))
    @php($profile_url = $profile_url ? route($profile_url) : '')
    @php($logout_url = $logout_url ? route($logout_url) : '')
@else
    @php($profile_url = $profile_url ? url($profile_url) : '')
    @php($logout_url = $logout_url ? url($logout_url) : '')
@endif

<li class="nav-item dropdown user-menu">
    {{-- User menu toggler --}}
    <a href="https://forms.gle/fGiRwPTz4TB8dBFs6" class="nav-link" target="_blank">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        Lapor Kendala Teknis
    </a>
</li>
<li class="nav-item dropdown user-menu">

    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if (config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-2"
                alt="{{ Auth::user()->name }}">
        @endif
        <span @if (config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
            {{ Auth::user()->Karyawan->nama }}
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        {{-- User menu header --}}
        @if (!View::hasSection('usermenu_header') && config('adminlte.usermenu_header'))
            <li
                class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
                @if (!config('adminlte.usermenu_image')) h-auto @endif">
                @if (config('adminlte.usermenu_image'))
                    <img src="{{ Auth::user()->adminlte_image() }}" class="img-circle elevation-2"
                        alt="{{ Auth::user()->name }}">
                @endif
                <p class="@if (!config('adminlte.usermenu_image')) mt-0 @endif">
                    {{ Auth::user()->name }}
                    @if (config('adminlte.usermenu_desc'))
                        <small>{{ Auth::user()->adminlte_desc() }}</small>
                    @endif
                </p>
            </li>
        @else
            @yield('usermenu_header')
        @endif

        {{-- Configured user menu links --}}
        @each('adminlte.partials.navbar.dropdown-item', $adminlte->menu('navbar-user'), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li>
            <div class="row">
                <div class="col-12 pt-2">
                    @if ($profile_url)
                        <a href="/edit_pwd" class="dropdown-item">
                            <i class="fa-solid fa-gear fa-fw"></i>
                            Ubah Password
                        </a>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
                <div class="col-12 py-2">
                    <a class="dropdown-item float-right @if (!$profile_url) btn-block @endif"
                        href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit(); localStorage.removeItem('lokal_token')">
                        <i class="fa fa-fw fa-power-off"></i>
                        {{ __('adminlte::adminlte.log_out') }}
                    </a>
                </div>
            </div>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if (config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
