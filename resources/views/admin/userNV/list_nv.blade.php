@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhân viên kho
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên nhân viên</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Đổi mật khẩu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listNV as $NV)
                            <tr class="odd gradeX" align="center">
                                <td>{{$NV->NameAd}}</td>
                                
                                    @if($NV->gioitinh==1)
                                        <td>Nam</td>
                                    
                                    @else
                                       <td> Nữ</td>
                                    
                                    @endif
                                
                               <td>
                                  {{$NV->email}}
                               </td>
                               <td>
                                {{$NV->phone}}
                             </td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($NV->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($NV->update_date)->format('d/m/Y H:i:s')}}</td>
                               <td class="center"><form action="{{URL::to('admin/nhan-vien/doi-mat-khau/'.$NV->idAd)}}" method="POST">@csrf<button type="submit" class='btn btn-default'> Đổi</button></form></td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/nhan-vien/xoa/'.$NV->idAd)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/nhan-vien/sua/'.$NV->idAd)}}">Edit</a></td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php $listNVGH=Session::get('giaohang'); ?>
                        <h1 class="page-header">Nhân viên giao hàng
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên nhân viên</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                <th>Đổi mật khẩu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listNVGH as $NVGH)
                            <tr class="odd gradeX" align="center">
                                <td>{{$NVGH->NameAd}}</td>
                                
                                    @if($NVGH->gioitinh==1)
                                        <td>Nam</td>
                                    
                                    @else
                                       <td> Nữ</td>
                                    
                                    @endif
                                
                               <td>
                                  {{$NVGH->email}}
                               </td>
                               <td>
                                {{$NVGH->phone}}
                             </td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($NVGH->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($NVGH->update_date)->format('d/m/Y H:i:s')}}</td>
                               <td class="center"><form action="{{URL::to('admin/nhan-vien/doi-mat-khau/'.$NVGH->idAd)}}" method="POST">@csrf<button type="submit" class='btn btn-default'> Đổi</button></form></td>
                                <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/nhan-vien/xoa/'.$NVGH->idAd)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/nhan-vien/sua/'.$NVGH->idAd)}}">Edit</a></td>
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
