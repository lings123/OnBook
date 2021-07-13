@extends('admin.layout.master')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User khách hàng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Họ Tên</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Điểm tích lũy</th>
                                <th>Ngày tạo</th>
                                <th>Thời gian xác nhận</th>
                                @if(Session::get('level')==1)<th>Xóa</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listKH as $user)
                            <tr class="odd gradeX" align="center">
                                <td>{{$user->name}}</td>
                                @if($user->gioitinh==1)
                                <td>Nam</td>
                            
                                    @else
                                    <td> Nữ</td>
                                    
                                    @endif
                                    
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                
                              
                                    <td>
                                        <form action="{{URL::to('admin/khach-hang/cap-nhat/'.$user->id)}}" method="POST">
                                            <div class="form-group">
                                                <select class="form-control" name="trangthai">
                                                    <option value="0" @if($user->active==0) selected @endif>Ẩn</option>
                                                    <option value="1" @if($user->active==1) selected @endif>Hiện</option>
                                                    
                                            </div>
                                            {{csrf_field()}}
                                            @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button> @endif
                                        </form>
                                    </td>
                                 
                                
                                
                                <td>{{$user->diemtichluy}}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s')}}</td>
                                <td>{{ \Carbon\Carbon::parse($user->email_verified_at)->format('d/m/Y H:i:s')}}</td>
                                @if(Session::get('level')==1) <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class='btn-del' href="{{URL::to('admin/khach-hang/xoa/'.$user->id)}}"> Xóa</a></td>
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