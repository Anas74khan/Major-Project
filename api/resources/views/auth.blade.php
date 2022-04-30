
@extends('index')

@section('style')

    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet">
    
    <style>
        .image-upload-container{
            border: 1px solid #eee;
            padding: 5px;
            border-radius: 5px;
            display: inline-block;
            cursor: pointer;
        }
        .image-upload-container input{
            display: none;
        }
        .image-upload-container img{
            height: 100px;
            border-radius: 5px;
        }
    </style>

    @yield('pageStyle')

@stop

@section('content')

    <div id="main-wrapper">
        
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    
                    <a class="navbar-brand" href="{{ url('dashboard') }}">
                        <b class="logo-icon">
                            <img src="{{ asset('images/logo-icon.png') }}" alt="logo" class="dark-logo" />
                            <img src="{{ asset('images/logo-light-icon.png') }}" alt="logo" class="light-logo" />
                        </b>
                        
                        <span class="logo-text">
                             <img src="{{ asset('images/logo-text.png') }}" alt="logo-text" class="dark-logo" />
                             <img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="logo-text" />
                        </span>
                    </a>
                    
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="navbar-nav float-right">
                        
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="flag-icon flag-icon-us"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>
                            </div>
                        </li> -->
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('images/user.jpg') }}" alt="user" class="rounded-circle" width="31">&nbsp;
                                {{ $admin['name'] }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="{{ asset('images/user.jpg') }}" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{ $admin['name'] }}</h4>
                                        <p class=" m-b-0">{{ $admin['email'] }}</p><!-- Change this with type -->
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ url('profile') }}"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="logout()"><i class="mdi mdi-exit-to-app m-r-5 m-l-5"></i> Logout</a>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        
        <aside class="left-sidebar">
            
            <div class="scroll-sidebar">
                
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Application & Web</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('dashboard') }}">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('section') }}">
                                <i class="mdi mdi-credit-card-multiple"></i>
                                <span class="hide-menu">Sections </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('slider') }}">
                                <i class="mdi mdi-content-copy"></i>
                                <span class="hide-menu">Sliders </span>
                            </a>
                        </li>

                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Products</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('category') }}">
                                <i class="mdi mdi-widgets"></i>
                                <span class="hide-menu">Categories </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('subcategory') }}">
                                <i class="mdi mdi-snowflake"></i>
                                <span class="hide-menu">Sub categories </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('brand') }}">
                                <i class="mdi mdi-alphabetical"></i>
                                <span class="hide-menu">Brands </span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('subcategories') }}">
                                <i class="mdi mdi-code-equal"></i>
                                <span class="hide-menu">Varieties </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('subcategories') }}">
                                <i class="mdi mdi-creation"></i>
                                <span class="hide-menu">Features </span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('product') }}">
                                <i class="mdi mdi-cart-plus"></i>
                                <span class="hide-menu">Products </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="hide-menu">Orders </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('orders') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> All Orders </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('orders/pending') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Pending Orders </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('orders/under_process') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Orders under process </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('orders/completed') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Orders Completed </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('orders/cancelled') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Orders Cancelled </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Order reports</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('report/orders') }}">
                                <i class="mdi mdi-cart"></i>
                                <span class="hide-cart">Completed Orders </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('report/orders') }}">
                                <i class="mdi mdi-cart-off"></i>
                                <span class="hide-cart-off">Cancelled Orders </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('report/categories') }}">
                                <i class="mdi mdi-widgets"></i>
                                <span class="hide-widgets">Categories </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('report/product') }}">
                                <i class="mdi mdi-cube-send"></i>
                                <span class="hide-cube-send">Products </span>
                            </a>
                        </li> -->

                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Extra</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('admin') }}" aria-expanded="false">
                                <i class="mdi mdi-account-circle"></i>
                                <span class="hide-account-circle">Employees</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('user') }}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-account-multiple">Users</span>
                            </a>
                        </li>
                        
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Personal</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('profile') }}" aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-account">My Account</span>
                            </a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ asset('inbox') }}" aria-expanded="false">
                                <i class="mdi mdi-inbox-arrow-down"></i>
                                <span class="hide-inbox-arrow-down">Inbox</span>
                            </a>
                        </li> -->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)" onclick="logout()" aria-expanded="false">
                                <i class="mdi mdi-exit-to-app"></i>
                                <span class="hide-exit-to-app">Logout</span>
                            </a>
                        </li>
                    
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="card rounded">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-5 align-self-center">
                                <h4 class="page-title">{{ ucfirst($breadcrumbs[count($breadcrumbs) - 1]['name']) }}</h4>
                                <div class="d-flex align-items-center">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">

                                            @for($i = 0; $i < count($breadcrumbs) - 1; $i++)
                                                <li class="breadcrumb-item">
                                                    <a href="{{ $breadcrumbs[$i]['url'] }}">{{ ucfirst($breadcrumbs[$i]['name']) }}</a>
                                                </li>
                                            @endfor

                                            <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($breadcrumbs[count($breadcrumbs) - 1]['name']) }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            @yield('pageContent')
            
            <footer class="footer text-center">
                Developed by <em>Major project team</em>.
            </footer>

        </div>
        
    </div>

    <div class="modal" id="modal-small" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

@stop


@section('script')

    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/app.init.light-sidebar.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/sparkline.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>

    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});
        const logout = () => swal({
                    title: "Are you sure?",
                    text: "You want to log out!",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonColor: "#f62d51",
                    confirmButtonText: "Yes, Log out!",
                    showLoaderOnConfirm: true
                },
                () => $.post("{{ url('logout') }}",data => window.location.replace('login'))
            );

        const imageUrl = `{!! asset('images') !!}/`;

        $(() => {

            $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
            $(document).on('click','.image-upload-container img',function(e){ $(this).parent().find('input').click(); });
            $(document).on('change','.image-upload-container input',function(e){
                const img = $(this).parent().find('img');
                const current = $(this).val();
                if(!current || current === "")
                    return img.attr('src',img.data('image'));

                img.attr('src',URL.createObjectURL(this.files[0]));
            });

        });
    </script>

    @yield('pageScript')
@stop
