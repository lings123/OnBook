
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{URL::to('admin/dashbroad')}}">Admin Page</a>
            </div>
            <!-- /.navbar-header -->
               
           
                       <ul class="nav navbar-top-links navbar-right">
                         
                    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       
                        <i class="fa fa-user fa-fw"></i> 
                        Hi Admin {{Session::get('NameAd')}}
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="{{URL::to('admin/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
            </ul>
        </nav>
                    <!-- /.dropdown-user -->
                
                <!-- /.dropdown -->
            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                         <li>
                            <a href="#">Back to HomePage</a>
                        </li>
                        <li>
                            <a href="{{URL::to('admin/dashbroad')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @if(Session::get('level')==1||Session::get('level')==2)
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Danh m???c<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/danh-muc/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/danh-muc/them')}}" >Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Lo???i s??ch <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/loai-sach/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/loai-sach/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i>S??ch<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/san-pham/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/san-pham/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> T??c gi???<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/tac-gia/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/tac-gia/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Nh?? xu???t b???n<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/nha-xuat-ban/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/nha-xuat-ban/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>B??a<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/bia/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/bia/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> ????n h??ng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @if(Session::get('level')==3)
                                <?php $idAd=Session::get('idAd'); ?>
                                    <li>
                                        <a href="{{URL::to('admin/don-hang/danh-sach-giao-hang/'.$idAd)}}">Danh s??ch giao h??ng </a>
                                    </li>
                                    @else
                                <li>
                                    <a href="{{URL::to('admin/don-hang/danh-sach')}}">Danh s??ch</a>
                                </li>
                                
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @if(Session::get('level')==1||Session::get('level')==2)
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Khuy???n m??i<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/khuyen-mai/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/khuyen-mai/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>H??nh th???c thanh to??n<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/thanh-toan/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/thanh-toan/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>????nh gi?? <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/danh-gia/danh-sach')}}">Danh s??ch</a>
                                </li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Blog<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/blog/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/blog/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Slider <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/slider/danh-sach')}}">Danh s??ch</a>
                                </li>
                                @if(Session::get('level')==1)
                                <li>
                                    <a href="{{URL::to('admin/slider/them')}}">Th??m</a>
                                </li>
                                @endif
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User kh??ch h??ng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('admin/khach-hang/danh-sach')}}">Danh s??ch</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li> 
                        @endif
                        <li>
                        @if(Session::get('level')==2)
                            
                                <a href="#"><i class="fa fa-users fa-fw"></i> User nh??n vi??n<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{URL::to('admin/nhan-vien/danh-sach')}}">Danh s??ch</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::to('admin/nhan-vien/them')}}">Th??m</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                           
                        @endif
                    </li> 
                        
                        
                    <br><br>
                    <br><br>
                    <br><br>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>