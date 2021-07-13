@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhà xuất bản
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên nhà xuất bản</th>
                                <th>Địa chỉ</th>
                                <th>Giới thiệu</th>
                                <th>Số sản phẩm</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1)<th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listPub as $Pub)
                            <tr class="odd gradeX" align="center">
                                <td>{{$Pub->namePub}}</td>
                                <td>{{$Pub->address_pub}}</td>
                               <td>
                                  {!!$Pub->desc_pub!!}
                               </td>
                               <td><?php $books=DB::table('books')->where('idPub',$Pub->idPub)->get() ?>{{$books->count()}}</td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($Pub->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($Pub->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1) <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/nha-xuat-ban/xoa/'.$Pub->idPub)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/nha-xuat-ban/sua/'.$Pub->idPub)}}">Edit</a></td>
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
@endsection
