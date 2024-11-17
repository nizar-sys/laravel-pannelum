<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            @if (settings('logo'))
                <a href="#"><img src="{{ asset(str_replace('public/', 'storage/', settings('logo'))) }}" alt="logo"></a>
            @else
                <a href="#"><img src="{{ asset('img/logoAdmin.png') }}" alt="logo"></a>
            @endif
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ Request::routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}"><i class="ti-home"></i><span>Dashboard</span></a>
                    </li>

                    <li class="{{ Request::routeIs('settings') ? 'active' : '' }}">
                        <a href="{{ route('settings') }}"><i class="ti-settings"></i> <span>Profile</span></a>
                    </li>

                    <li class="{{ Request::routeIs('helps') ? 'active' : '' }}">
                        <a href="{{ route('helps') }}"><i class="ti-menu-alt"></i> <span>Bantuan</span></a>
                    </li>

                    <li class="{{ Request::routeIs('videos.*') ? 'active' : '' }}">
                        <a href="{{ route('videos.index') }}"><i class="ti-video-clapper"></i> <span>Video Animasi</span></a>
                    </li>

                    @if (auth()->check())
                        <li class="{{ Request::routeIs('config') ? 'active' : '' }}">
                            <a href="{{ route('config') }}"><i class="ti-map-alt"></i> <span>Pengaturan Denah Lokasi</span></a>
                        </li>
                    @else
                        <li class="{{ Request::routeIs('virtual-tour') ? 'active' : '' }}">
                            <a href="{{ route('virtual-tour') }}"><i class="ti-map-alt"></i> <span>Denah Lokasi</span></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
