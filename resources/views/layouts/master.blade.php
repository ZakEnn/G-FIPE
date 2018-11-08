
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GFIPE | Starter</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper " id="app">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-custom-menu bg-white navbar-light border-bottom " >
        <div class="img-thumbnail container-fluid" style="background-color: white">
            <img  height="78px" width="20%"  src="./img/logo_d.png"  alt="logo">
            <img  height="78px" width="75%"  src="./img/image.png"   alt="image">
        </div>
        <ul class="navbar-nav" style="margin-bottom: 10px">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa"><img src="./img/menu1.png"></i></a>
            </li>
        </ul>
        <p class="text-center breadcrumb bg-gray-light text-bold " style="margin-top:0.8%">Système de gestion de la formation intégrée au personnel de l'état</p>
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm" style="margin-bottom: 10px">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button disabled="true" class="btn btn-navbar" type="submit">
                        <i class="fa">
                            <img src="./img/search.png" height="10px">
                        </i>
                    </button>
                </div>
            </div>
        </form>
 </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="./img/formation.png" alt="Formation Logo"  height="60px" class="img-circle elevation-1"
                 style="opacity: .8">
            <span class="brand-text font-weight-light" style="padding-left: 30px">G-FIPE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                <div class="info">
                    <a href="#" class="d-block" >{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2" >
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link" active-class="active" exact>
                            <i class="nav-icon fa"> <img src="./img/dashboard.png" style="margin-right: 20px"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/myStore" class="nav-link" active-class="active" exact>
                            <i class="nav-icon fa"> <img src="./img/store.png" style="margin-right: 20px"></i>
                            <p>
                                Store
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">


                            <i class="nav-icon fa"> <img src="./img/book.png" style="margin-right: 20px"></i>
                            <b class="text-center"> Formation </b>
                            <p>
                                <i class="right fa " >
                                    <img src="./img/right-chevron.png" style="margin-top: 2px;">
                                </i>
                            </p>

                        </a>
                        <ul class="nav nav-treeview">
                            @foreach($formation as $theme)
                            <li class="nav-item ">
                                <router-link   to="/formation/{{$theme->id}}" active-class="active" class="nav-link" exact>
                                    <i class="fa" aria-hidden="true"></i>
                                    <p>{{$theme->libelle}}</p>
                                </router-link>
                            </li>
                            @endforeach
                        </ul>
                    </li>

            @if(Auth::user()->hasType('admin'))

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa"> <img src="./img/setting.png" style="margin-right: 20px"></i>
                            <b class="text-center"> Management </b>
                            <p>
                                <i class="right fa " >
                                    <img src="./img/right-chevron.png" style="margin-top: 2px">
                                </i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/management/agents"
                                             active-class="active"
                                             class="nav-link" exact>
                                    <i class="fa" aria-hidden="true"></i>
                                    <p>Agents</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/management/formations"
                                             class="nav-link"
                                             active-class="active">
                                    <i class="fa" aria-hidden="true"></i>
                                    <p>Formations</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link  to="/management/sessions" class="nav-link" active-class="active">
                                    <i class="fa"></i>
                                    <p>Sessions</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link   to="/management/tests" class="nav-link" active-class="active">
                                    <i class="fa"></i>
                                    <p>Tests</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
              @endif

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            
                            <i class="nav-icon fa"> <img src="./img/logout.png" ></i>
                            <p>{{ __('Logout') }}</p>

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">

        <div class="content">
            <div class="container-fluid">
                <router-view :auth_user="'{{ auth()->user()?? null }}'"></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
        </div>

    </div>

    <footer class="swal2-footer" >
        <div class="float-right d-none d-sm-inline">
                    Douanes © 2018 , Inc.
        </div>
        <br>
    </footer>

</div>

<script src="{{ asset('js/app.js') }}" ></script>

</body>

</html>
