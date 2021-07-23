<header>

<!-- Sidebar navigation -->
    <ul id="slide-out" class="side-nav custom-scrollbar">
        <!-- Logo -->
        <li>
            <div class="logo-wrapper waves-light">
                <a href="#"><img src="{{config('app.site_logo')}}" class="img-fluid flex-center"></a>
            </div>
        </li>
        <!--/. Logo -->
        <!--Social-->
        <li>
            <ul class="social">
                <li><a class="icons-sm fb-ic" href="{{config('app.social_fb')}}"><i class="fa fa-facebook"> </i></a></li>
                <li><a class="icons-sm pin-ic" href="{{config('app.social_pinterest')}}"><i class="fa fa-pinterest"> </i></a></li>
                <li><a class="icons-sm gplus-ic" href="{{config('app.social_gplus')}}"><i class="fa fa-google-plus"> </i></a></li>
                <li><a class="icons-sm tw-ic" href="{{config('app.social_twitter')}}"><i class="fa fa-twitter"> </i></a></li>
            </ul>
        </li>
        <!--/Social-->
        <!--Search Form-->
        <li>
            <form class="search-form" role="search" action="{{action('VideoController@search')}}">
                <div class="form-group waves-light">
                    <input type="text" name="keyword" class="form-control" placeholder="Search">
                </div>
            </form>
        </li>
        <!--/.Search Form-->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a class="collapsible-header waves-effect" href="{{url('/')}}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a class="collapsible-header waves-effect" href="{{url('trending')}}"><i class="fa fa-fire"></i> Trending</a>
                </li>  
                @if(Auth::check())
                    @if(Auth::user()->role == 1)
                    <li><a class="collapsible-header waves-effect" href="{{url('admin/dashboard')}}"><i class="fa fa-user-secret"></i> Admin Panel</a>
                    </li>     
                    @endif

                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i> My Account<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            @if(config('app.user_upload') == 1 || config('app.user_embed') == 1 || \Auth::user()->role == 1)
                            <li><a href="{{url('upload')}}" class="waves-effect">Upload/Embed Video</a>
                            </li> 
                            @endif
                            @if(config('app.user_import') == 1 || \Auth::user()->role == 1)
                            <li><a href="{{url('import-videos')}}" class="waves-effect">Import Videos</a>
                            </li>  
                            @endif      
                            <li><a href="{{url('my-videos')}}" class="waves-effect">My Videos</a>
                            </li> 
                            <li><a href="{{url('history')}}" class="waves-effect">History</a>
                            </li>
                            <li><a href="{{url('saved-videos')}}" class="waves-effect">Saved Videos</a>
                            </li>
                            <li><a href="{{url('liked-videos')}}" class="waves-effect">Liked Videos</a>
                            </li>
                            <li><a href="{{url('password')}}" class="waves-effect">Change Password</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Categories<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                        @forelse($categories as $category)
                            <li><a href="{{url($category->slug)}}" class="waves-effect">{{$category->name}}</a>
                            </li>
                        @empty
                            <li href="#" class="waves-effect">No categories</li>
                        @endforelse
                        </ul>                        
                    </div>
                </li>
                <li><a href="{{route('contact')}}" class="collapsible-header waves-effect"><i class="fa fa-envelope-o"></i> Contact us</a>
                </li>
                @if(Auth::check())
                <li><a href="{{url('logout')}}" class="collapsible-header waves-effect"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
                @endif
            </ul>
        </li>
        <!--/. Side navigation links -->
        <div class="sidenav-bg mask-strong"></div>
    </ul>
    <!--/. Sidebar navigation -->

<!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
        </div>
        <!-- Breadcrumb-->
        <div class=" mr-auto">
            <a href="{{url('/')}}"><img src="{{config('app.site_logo')}}" height="40" style="margin-left: 10px;"></a>
        </div>

<form class="form-inline waves-effect waves-light" id="search_form" action="{{action('VideoController@search')}}">
<div class="ui-widget hidden-sm-down">
                        <input class="form-control" style="width: 600px;" type="text" name="keyword" placeholder="Search" id="auto_complete_search"  @if(app('request')->get('keyword')) value="{{app('request')->get('keyword')}}" @endif >

</div>
                    </form>

        <ul class="nav navbar-nav nav-flex-icons ml-auto">
        @if(Auth::check())
            @if(config('app.user_upload') == 1 || config('app.user_embed') == 1 || \Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{url('upload')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Upload/Embed Video" title="Upload/Embed Video"><i class="fa fa-video-camera"></i> <span class="hidden-sm-down"></span></a>
            </li>           
            @endif
            @if(config('app.user_import') == 1 || \Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link" href="{{url('import-videos')}}" data-toggle="tooltip" data-placement="bottom" data-original-title="Import Youtube Videos" title="Import Youtube Videos"><i class="fa fa-download"></i> <span class="hidden-sm-down"></span></a>
            </li>
            @endif
            <li class="nav-item btn-group">
                <a class="nav-link" id="btn-clps" data-activates="slide-out"><i class="fa fa-user"></i> <span class="hidden-sm-down">{{Auth::user()->name}}</span></a>
            </li>
                        
        @else
            <li class="nav-item"><a class="nav-link opn_login" data-toggle="modal" data-target="#modalLogin" data-dismiss="modal"><i class="fa fa-sign-in"></i> <span class="hidden-sm-down">Log In</span></a></li>
        @endif


        </ul>
    </nav>
    <!-- /.Navbar -->

    </header>