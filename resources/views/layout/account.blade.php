<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'e-Procurement Mangkokku') }}</title> --}}
        <title>e-Procurement Mangkokku</title>

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{ asset('css/style.css')}}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
        <link href="{{ asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
        <link href="{{ asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/plugins/dropzone/basic.css')}}" rel="stylesheet">
        <link href="{{ asset('css/plugins/dropzone/dropzone.css')}}" rel="stylesheet">
        <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/plugins/switchery/switchery.css') }}" rel="stylesheet">

        <script src="{{ asset('js/jquery-3.1.1.min.js')}}" ></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
        <script src="{{ asset('js/plugins/select2/select2.full.min.js')}}"></script>
        <script src="{{ asset('js/plugins/dropzone/dropzone.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
        <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/plugins/switchery/switchery.js') }}"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('include.header')
                </div>
            </div>
            <div class="row">
                <div  class="col-3">
                    <nav class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav metismenu" id="side-menu">
                      
                            <li class="nav-header navy-bg" >
                            <a href="{{ url('/account') }}">
                                <center>
                                    <div> <i class="fa fa-desktop text-white fa-3x py-2" ></i></div>

                                    @if(session()->get(config("global.session_user_obj"))->um_user_role_id === config("global.user_role_admin"))
                                    <strong class="text-white">Admin Dashboard</strong>
                                    @else
                                    <strong class="text-white">My Account</strong>
                                    @endif

                                </center>
                                </a>
                            </li>
                         
                            <?php
                            $ar_per=json_decode(session()->get(config("global.session_permissions_tabs")),true);

                            ?>

                              @foreach ($ar_per as $permission)

                                <?php $url= url('/account/'.$permission["url_path"]) ;
                                
                                       $url_current=url()->current();
                                      // dd($url,$url_current);
                                ?>

                              <li class="{{ ($url === $url_current ? 'active':'') }}">
                                <a href="/account/{{$permission['url_path'] }}"><i class="fa fa-folder-o"></i><span class="nav-label">{{$permission["tab_name"] }}</span></a>
                            
                              </li>
                              @endforeach
                        </ul>

                    </div>
                </nav>

                </div>

                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

