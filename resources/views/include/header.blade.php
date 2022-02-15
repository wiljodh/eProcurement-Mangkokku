<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">

                <a href="/">
                <div class="navbar-header py-2 px-2">
                    <img alt="LOGO" class="" src="{{ asset('images/logo-only.png')}}" style="width:50px;height:55px" />
                    <strong class="text-secondary">e-Procurement Mangkokku</strong>
                </div>
                </a>

                   <ul class="nav navbar-top-links navbar-right">
                    @if(empty(session(config("global.session_user_obj"))))
                        <li >
                            <a href="/login">
                                <i class="fa fa-user"></i> &nbsp;Login
                            </a>
                        </li>
                        <li >
                            <a href="/register">
                                <i class="fa fa-user-plus"></i> &nbsp;Register
                            </a>
                        </li>

                    @else
                       <li><i class="fa fa-user-circle-o fa-2x"></i> </li>
                       <li>
                         <a href="/profile">
                          <span class="m-r-sm text-muted welcome-message"> &nbsp;<strong>{{ session()->get(config("global.session_user_obj"))->firstname }} {{ session()->get(config("global.session_user_obj"))->lastname }}</strong>
                          @if(session()->get(config("global.session_user_obj"))->um_user_role_id === config("global.user_role_admin"))
                          (Admin)
                          @endif
                          </span>
                        </a>
                        </li>
                        <li class="">
                            <a href="/account" class="text-success">
                                <i class="fa fa-square-o"></i>
                                Account
                            </a>
                        </li>
                        <li>
                            <a href="/user-actions/logout" class="text-danger">
                                <i class="fa fa-sign-out"></i>Log out
                            </a>
                        </li>
                    @endif
                    </ul>

                </nav>
