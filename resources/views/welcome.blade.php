<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Virtual Tour {{ settings('name') ? '| ' . settings('name') : '' }}</title>

    {{-- Bootstrap --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/660f452c646af-Kementerian-ATR-BPN.png') }}">

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Fahkwang:400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    {{-- Script --}}
    <script src="{{ asset('js/modernizr.js') }}"></script>

    {{-- Pannellum --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <!-- Fading Out Overlay -->
    <script>
        $(document).ready(function() {
            $("#hide").click(function() {
                $(".home-content-table").fadeOut(1000);
            });
        });
    </script>
</head>

<body id="top">

    <header>
        <a id="header-menu-trigger" href="#0">
            <span class="header-menu-text">Menu</span>
            <span class="header-menu-icon"></span>
        </a>

        <nav id="menu-nav-wrap">
            <a href="#0" class="close-button" title="close"><span>Close</span></a>

            <h3>Virtual Tour {{ settings('name') ? '| ' . settings('name') : '' }}</h3>

            <ul class="nav-list">
                @foreach ($scenes as $scene)
                    <li><a class="smoothscroll" onclick="loadScene({{ $scene->id }})">{{ $scene->title }}</a></li>
                @endforeach
            </ul>
        </nav>
    </header>

    <div class="sliderWrap">
        <ul>
            <li class="info">
                <i class="fa fa-home" aria-hidden="true"></i>
                <div class="sliderBar">
                    <a href="{{ route('home') }}">
                        <p>Dashboard</p>
                    </a>
                </div>
            </li>
            <li class="info">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                <div class="sliderBar">
                    <a href="{{ route('settings') }}">
                        <p>Profile</p>
                    </a>
                </div>
            </li>
            <li class="info">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <div class="sliderBar">
                    <a href="{{ route('helps') }}">
                        <p>Bantuan</p>
                    </a>
                </div>
            </li>

            <li class="info">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
                <div class="sliderBar">
                    <a href="{{ route('videos.index') }}">
                        <p>Video Animasi</p>
                    </a>
                </div>
            </li>
            <li class="info">
                <i class="fa fa-map" aria-hidden="true"></i>
                <div class="sliderBar">
                    <a onclick="showModal()">
                        <p> Denah {{ settings('name') ? settings('name') : '' }}</p>
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <div class="modal fade" id="denahModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('/img/LETAKKKKKKKKK.png') }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- home-->
    <div class="home-content-table">
        <div class="home-content-tablecell">
            <div class="row">
                <div class="col-twelve">
                    <h1 class="animate-intro"> Virtual Tour {{ settings('name') ? '| ' . settings('name') : '' }} </h1>
                    <noscript>
                        <div id="warning"><strong>Mohon Aktifkan JavaScript di Browser Anda untuk Menggunakan Website
                                ini<strong></div>
                    </noscript>
                    <div class="more animate-intro">
                        <a id="hide" class="button stroke"> Start Tour </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="pannellum">
        <div class="overlay"></div>
    </section>

    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- Java Script -->
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    @if ($fscene)
        <script>
            var scenes = @json($scenes); // Convert $scenes to a JavaScript object
            var hotspots = @json($hotspots); // Convert $hotspots to a JavaScript object

            var viewerConfig = {
                "default": {
                    "firstScene": "{{ $fscene->id }}",
                    "autoLoad": true,
                    "sceneFadeDuration": 2000,
                    "autoRotate": -1,
                    "autoRotateInactivityDelay": 30000
                },
                "scenes": {}
            };

            // Populate scenes dynamically
            scenes.forEach(function(scene) {
                viewerConfig.scenes[scene.id] = {
                    "title": scene.title,
                    "hfov": scene.hfov,
                    "pitch": scene.pitch,
                    "yaw": scene.yaw,
                    "type": scene.type,
                    "panorama": "{{ asset('/img/uploads/') }}" + "/" + scene.image,
                    "hotSpots": hotspots.filter(function(hotspot) {
                        return hotspot.sourceScene === scene.id;
                    }).map(function(hotspot) {
                        var hotspotConfig = {
                            "pitch": hotspot.pitch,
                            "yaw": hotspot.yaw,
                            "type": hotspot.type,
                            "text": hotspot.info
                        };

                        if (hotspot.type === 'scene') {
                            hotspotConfig.sceneId = hotspot.targetScene;
                        }

                        return hotspotConfig;
                    })
                };
            });

            var load = pannellum.viewer('pannellum', viewerConfig);

            function loadScene(clicked_id) {
                load.loadScene(clicked_id);
            }
        </script>
    @endif

    <script>
        function showModal() {
            $('#denahModal').modal('show');
        };
    </script>
</body>

</html>
