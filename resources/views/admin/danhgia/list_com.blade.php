@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đánh giá
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Nội dung</th>
                                <th>Tên khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Điểm</th>
                                <th>Ngày tạo</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listCom as $com)
                            <tr class="odd gradeX" align="center">
                                <td>{{$com->noidung}}</td>
                                
                                   <?php
                                    $kh=DB::table('users')->where('id',$com->idKH)->first();
                                    $book=DB::table('books')->where('idBook',$com->idBook)->first();
                                   ?>
                                
                               <td>
                                  {{$kh->name}}
                               </td>
                               <td>
                                {{$book->NameBook}}
                             </td>
                             <td>
                                {{$com->diem}}
                             </td>
                               <td>{{ \Carbon\Carbon::parse($com->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1)<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class='btn-del' href="{{URL::to('admin/danh-gia/xoa/'.$com->idCom)}}"> Xóa</a></td>
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
