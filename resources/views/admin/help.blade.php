@extends('admin.main')

@section('title', 'Bantuan')

@section('content')
    <div class="row mb-3">
        <a class="col-md-6" href="{{ route('home') }}">
            <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                    <div class="icon"><i class="ti-home"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                        <h3 class="header-title mb-0">Dashboard</h3>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <h6 class="text-dark">
                            Dashboard adalah halaman utama yang menampilkan informasi umum mengenai aplikasi ini.
                        </h6>
                    </div>
                </div>
            </div>
        </a>
        <a class="col-md-6" href="{{ route('settings') }}">
            <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                    <div class="icon"><i class="ti-settings"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                        <h3 class="header-title mb-0">Profile</h3>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <h6 class="text-dark">
                            Profile adalah halaman yang berisi informasi mengenai profil aplikasi ini.
                        </h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="row mb-3">
        <a class="col-md-6" href="{{ route('helps') }}">
            <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                    <div class="icon"><i class="ti-menu-alt"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                        <h3 class="header-title mb-0">Bantuan</h3>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <h6 class="text-dark">
                            Bantuan adalah halaman yang berisi informasi mengenai cara penggunaan aplikasi ini.
                        </h6>
                    </div>
                </div>
            </div>
        </a>
        <a class="col-md-6" href="{{ route('config') }}">
            <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                    <div class="icon"><i class="ti-map-alt"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                        <h3 class="header-title mb-0">Pengaturan Denah Lokasi</h3>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <h6 class="text-dark">
                            Pengaturan Denah Lokasi adalah halaman yang berisi informasi mengenai pengaturan denah lokasi.
                        </h6>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection
