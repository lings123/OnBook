@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khuyến mãi
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Mã khuyến mãi</th>
                                <th>Trạng thái</th>
                                <th>Phần trăm</th>
                                <th>Mô tả</th>
                                <th>Số lần áp dụng</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listSale as $sale)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sale->nameSale}}</td>
                                
                                <td>
                                    <form action="{{URL::to('admin/khuyen-mai/cap-nhat/'.$sale->idSale)}}" method="POST">
                                        <div class="form-group">
                                            <select class="form-control" name="trangthai">
                                                <option value="0" @if($sale->active==0) selected @endif>Ẩn</option>
                                                <option value="1" @if($sale->active==1) selected @endif>Hiện</option>
                                                
                                        </div>
                                        {{csrf_field()}}
                                        @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button>@endif
                                    </form>
                                </td>
                               <td>
                                  {{$sale->phantram}}
                               </td>
                               <td>
                                {!!$sale->mota!!}
                             </td>
                             <td>{{$sale->solan}}</td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($sale->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($sale->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1) <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/khuyen-mai/xoa/'.$sale->idSale)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/khuyen-mai/sua/'.$sale->idSale)}}">Edit</a></td>
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
