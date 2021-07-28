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
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Điểm</th>
                                <th>Ngày tạo</th>
                                <th>trạng thái</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listCom as $com)
                            <tr class="odd gradeX" align="center">
                                <td>{{$com->noidung}}</td>
                                <td>{{$com->idBill}}</td>
                                   <?php
                                  
                                    $book=DB::table('books')->where('idBook',$com->idBook)->first();
                                   ?>
                                
                               <td>
                                  {{$com->nameKH}}
                               </td>
                               <td>
                                {{$book->NameBook}}
                             </td>
                             <td>
                                {{$com->diem}}
                             </td>
                               <td>{{ \Carbon\Carbon::parse($com->update_date)->format('d/m/Y H:i:s')}}</td>
                               
                               <td class="center">
                                <form action="{{URL::to('admin/danh-gia/cap-nhat/'.$com->idCom)}}" method="POST">
                                    <div class="form-group">
                                        <select class="form-control" name="trangthai">
                                            <option value="0" @if($com->status==0) selected @endif>Ẩn</option>
                                            <option value="1" @if($com->status==1) selected @endif>Hiện</option>
                                            
                                    </div>
                                    {{csrf_field()}}
                                    @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button>@endif
                                </form>
                                </td>
                            
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
