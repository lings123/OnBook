@extends('admin.layout.master')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Blog
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <?php

                    ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                               
                                <th>Tiêu đề</th>
                                <th>Giới thiệu</th>
                                <th>Người đăng</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1)<th>Delete</th>
                                <th>Edit</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listBlog as $blog)
                            <tr class="odd gradeX" align="center">
                               
                                <td>{{$blog->tieude}}</td>
                                <td>{!!$blog->gioithieu!!}</td>
                                <td>
                                    <?php $Ad=DB::table('admin')->where('idAd',$blog->idAd)->first() ?>   
                                    {{$Ad->NameAd}}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($blog->create_date)->format('d/m/Y H:i:s')}}</td>
                                <td>{{ \Carbon\Carbon::parse($blog->update_date)->format('d/m/Y H:i:s')}}</td>    
                                @if(Session::get('level')==1)<td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="{{URL::to('admin/blog/xoa/'.$blog->idBlog)}}"  >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/blog/sua/'.$blog->idBlog)}}">Sửa</a></td>
                                @endif
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
               
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
