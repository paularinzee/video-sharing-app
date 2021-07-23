<!--Footer-->
    <footer class="page-footer center-on-small-only">

        <!--Footer Links-->
        <div class="container-fluid">
            <div class="row">

                <!--First column-->
                <div class="col-lg-12">
                	<p class="text-center" style="margin:0px"><a class="yellow-text" href="{{url('pages/privacy-policy')}}">privacy</a> | <a class="yellow-text" href="{{url('pages/terms-condition')}}">terms</a> | <a class="yellow-text" href="{{route('contact')}}">contact</a></p>
                    <p class="text-center">{{config('app.footer_text')}}</p>
                </div>
                <!--/.First column-->

            </div>
        </div>
        <!--/.Footer Links-->


        <!--Copyright-->
        <div class="footer-copyright">
            <div class="container-fluid">
                © 2017 Copyright <a href="{{config('app.APP_URL')}}"> {{config('app.site_name')}}</a>.
                
            </div>
        </div>
        <!--/.Copyright-->

    </footer>
    <!--/.Footer-->



@if(!Auth::check())
<!--Modal: Login Form-->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header light-blue darken-3 white-text">
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="title"><i class="fa fa-user"></i> Log in</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form id="login_form" method="post" action="{{action('UserController@doLogin')}}">
                    <div class="md-form form-sm">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="text" name="email" class="form-control">
                        <label for="form30">Your email</label>
                    </div>

                    <div class="md-form form-sm">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" name="password" class="form-control">
                        <label for="form31">Your password</label>
                    </div>

                    <div id="login_response"></div>


                    <div class="mt-2 text-center">
                        <button class="btn btn-info" type="submit">Log in <i class="ml-1 fa fa-sign-in"></i></button>
                    </div>
                </form>
            </div>

            <!--Footer-->
            <div class="modal-footer">
                <div class="mt-1 text-center options text-md-right">
                    <p>Not a member? <a class="opn_signup" data-toggle="modal" data-target="#modalRegister" data-dismiss="modal" href="#">Sign Up</a></p>
                    <p>Forgot <a class="opn_forgot" data-toggle="modal" data-target="#modalForgot" data-dismiss="modal" href="#">Password?</a></p>
                </div>
                <button type="button" class="ml-auto btn btn-outline-info waves-effect" data-dismiss="modal">Close <i class="ml-1 fa fa-times-circle"></i></button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login Form-->



<!--Modal: Register Form-->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header light-blue darken-3 white-text">
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="title"><i class="fa fa-user-plus"></i> Register</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form id="register_form" method="post" action="{{action('UserController@register')}}">

                <div class="md-form form-sm">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" name="name" class="form-control">
                    <label for="form32">Your name</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="text" name="email" class="form-control">
                    <label for="form32">Your email</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" name="password" class="form-control">
                    <label for="form33">Your password</label>
                </div>

                <div id="register_response"></div>
                

                <div class="mt-2 text-center">
                    <button class="btn btn-info" type="submit">Sign up <i class="ml-1 fa fa-sign-in"></i></button>
                </div>
                </form>

            </div>
            <!--Footer-->
            <div class="modal-footer">
                <div class="mt-1 text-center options text-md-right">
                    <p>Already have an account? <a class="opn_login" data-toggle="modal" data-target="#modalLogin" data-dismiss="modal" href="#">Log In</a></p>
                </div>
                <button type="button" class="ml-auto btn btn-outline-info waves-effect" data-dismiss="modal">Close <i class="ml-1 fa fa-times-circle"></i></button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Register Form-->


<!--Modal: Forgot Form-->
<div class="modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header light-blue darken-3 white-text">
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="title"><i class="fa fa-user"></i> Forgot Password?</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <form id="forgot_form" method="post" action="{{action('UserController@recover')}}">
                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="text" name="email" class="form-control">
                    <label for="form30">Your email</label>
                </div>
            
                <div id="forgot_response"></div>

                <div class="mt-2 text-center">
                    <button class="btn btn-info" type="submit">Submit <i class="ml-1 fa fa-sign-in"></i></button>
                </div>
                </form>

            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="ml-auto btn btn-outline-info waves-effect" data-dismiss="modal">Close <i class="ml-1 fa fa-times-circle"></i></button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Forgot Form-->
@endif

