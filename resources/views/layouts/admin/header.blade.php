    <!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/assets/images/favicon.png')}}">
    <title>Skill Precision Balls PVT. LTD.</title>
    <!-- Custom CSS -->
   
   
    <!-- Custom CSS -->
  
    <!-- Custom CSS -->
    {!! Html::style('/assets/assets/extra-libs/c3/c3.min.css') !!}
    <!-- Custom CSS -->
    {!! Html::style('assets/assets/libs/summernote/dist/summernote-bs4.css') !!}
    
    {!! Html::style('assets/assets/libs/select2/dist/css/select2.min.css') !!}

    {!! Html::style('/assets/dist/css/style.min.css') !!}
    {!! Html::style('/assets/assets/extra-libs/prism/prism.css') !!}
    {!! Html::script('/assets/assets/extra-libs/prism/prism.js') !!}
    
    {!! Html::script('/assets/assets/libs/jquery/dist/jquery.min.js') !!}

    {!! Html::script('/assets/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') !!}
    {!! Html::script('/assets/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') !!}
    {!! Html::script('/assets/assets/libs/popper.js/dist/umd/popper.min.js') !!}
     {!! Html::script('/assets/assets/extra-libs/jqbootstrapvalidation/validation.js') !!}

{!! Html::script('/assets/assets/libs/select2/dist/js/select2.full.min.js') !!}
{!! Html::script('/assets/assets/libs/select2/dist/js/select2.min.js') !!}
   

    <!--This page datatable -->
     {!! Html::style('/assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') !!}
     {!! Html::script('/assets/assets/extra-libs/DataTables/datatables.min.js') !!}
   <!--  {!! Html::script('/assets/assets/extra-libs/buttons/1.5.1/js/dataTables.buttons.min.js') !!} -->
    
     <!-- for switch  -->
     {!! Html::style('/assets/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') !!}

     <!-- datepicker -->
     {!! Html::style('/assets/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}
     {!! Html::style('/assets/assets/libs/jsgrid/dist/jsgrid.min.css') !!}
     {!! Html::script('/assets/assets/libs/moment/moment.js') !!}
     {!! Html::script('/assets/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}
     {!! Html::style('/assets/assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}
     {!! Html::script('/assets/assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') !!}

     <!-- for Print -->
     {!! Html::script('/assets/dist/js/pages/samplepages/jquery.PrintArea.js') !!}

    <!-- for pages-gallery -->
    {!! Html::script('/assets/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js') !!}
    {!! Html::script('/assets/assets/libs/magnific-popup/meg.init.js') !!}


    <!-- for Touch Spin -->
    {!! Html::style('/assets/assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') !!}
    {!! Html::script('/assets/assets/libs/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') !!}

    {!! Html::style('/assets/assets/libs/jquery-steps/jquery.steps.css') !!}
    {!! Html::style('/assets/assets/libs/jquery-steps/steps.css') !!}
    {!! Html::script('/assets/assets/libs/jquery-steps/build/jquery.steps.min.js') !!} 

    {!! Html::style('/assets/assets/libs/toastr/build/toastr.min.css') !!}
    {!! Html::script('/assets/assets/libs/toastr/build/toastr.min.js') !!} 

    <link href="/assets/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="/assets/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <script src="/assets/dist/js/pages/email/email.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body data-theme="dark">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader" style="display: none;">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin1" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin1">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="/home">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            
                           
                          <!--   {{ HTML::image('assets/assets/images/logo-icon.png', 'This is an image', ['class' => 'dark-logo']) }} -->
                            <!-- Light Logo icon -->
                         <!--    {{ HTML::image('company_logo/skill-precision-balls-logo.png', 'This is an image', ['class' => 'dark-logo']) }}
                            {{ HTML::image('company_logo/skill-precision-balls-logo.png', 'This is an image', ['class' => 'light-logo']) }} -->
                           <!--   {{ HTML::image('assets/assets/images/logo-light-icon.png', 'This is an image', ['class' => 'light-logo']) }} -->

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                          
                             {{ HTML::image('company_logo/skill-precision-balls-logo.png', 'This is an image', ['class' => 'dark-logo','height'=>'100','width'=>'200']) }}
                             <!-- Light Logo text -->    
                             
                             {{ HTML::image('company_logo/skill-precision-balls-logo.png', 'This is an image', ['class' => 'light-logo','height'=>'60','width'=>'220']) }}
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
               
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                   
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">4 New</h4>
                                            <span class="font-light">Notifications</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications ps-container ps-theme-default" data-ps-id="7e9a673b-429c-4c12-3743-c5fdda58c090">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Event today</h5> <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Settings</h5> <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-processing"></i>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow"><span class="bg-danger"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title text-white bg-danger">
                                            <h4 class="m-b-0 m-t-5">5 New</h4>
                                            <span class="font-light">Messages</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body ps-container ps-theme-default" data-ps-id="41ef3f72-446d-c9ee-954d-a4aea1f9f726">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="{{asset('assets/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle"> <span class="profile-status online pull-right"></span> </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="{{asset('assets/assets/images/users/2.jpg')}}" alt="user" class="rounded-circle"> <span class="profile-status busy pull-right"></span> </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="{{asset('assets/assets/images/users/3.jpg')}}" alt="user" class="rounded-circle"> <span class="profile-status away pull-right"></span> </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> <img src="{{asset('assets/assets/images/users/4.jpg')}}" alt="user" class="rounded-circle"> <span class="profile-status offline pull-right"></span> </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                            </a>
                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <b>See all e-Mails</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('assets/assets/images/users/1.jpg')}}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="{{asset('assets/assets/images/users/1.jpg')}}" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{ucfirst(Auth()->user()->name)}}</h4>
                                        <p class=" m-b-0">{{ucfirst(Auth()->user()->email)}}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                         
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href='EditUser/{{Auth()->user()->id}}'><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
      
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps-container ps-theme-default ps-active-y" data-ps-id="a9bca1aa-85ce-d6df-82d2-d811d046e3c0">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic"><img src="{{asset('assets/assets/images/users/1.jpg')}}" alt="users" class="rounded-circle" width="40"></div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium">{{ucfirst(Auth()->user()->name)}} <i class="fa fa-angle-down"></i></h5>
                                        <span class="op-5 user-email">{{Auth()->user()->email}}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                       
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                   
                        <!-- User Profile-->
                        
               

                         @foreach($categories as $item)

                             @if($item->children->count() >= 0 )                             

                                @if(in_array($item->admin_id,unserialize($role_permission->view_permission)))
                                
                                <li class="sidebar-item"> <a class="sidebar-link  has-arrow waves-effect waves-dark" '@if(!empty($item->route))' href="{{url($item->route)}}" '@endif' aria-expanded="false"><i class="{{$item->icon}}"></i><span class="hide-menu">{{ $item->title }} </span></a>
                                   
                                    <ul aria-expanded="false" class="collapse  first-level">
                                            @foreach($item->children as $submenu1)

                                                 @if($submenu1->children->count() >=0)   
                                                     
                                                    @if(in_array($submenu1->admin_id,unserialize($role_permission->view_permission)))
                                        <li class="sidebar-item"><a '@if(!empty($submenu1->route))' href="{{url($submenu1->route)}}" '@endif' class="sidebar-link"><i class="{{$submenu1->icon}}"></i><span class="hide-menu"> {{ $submenu1->title }} </span></a></li>
                                                    @endif
                                                @endif
                                           @endforeach                                                              
                                    </ul>

                                </li>
                             @endif
                         @endif

                    @endforeach 
                       
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 119px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 5px;"></div></div></div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">