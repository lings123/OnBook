@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Số lượng sản phẩm</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listCate as $cate)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cate->nameCate}}</td>
                                <td>
                                <form action="{{URL::to('admin/danh-muc/cap-nhat/'.$cate->idCate)}}" method="POST">
                                    <div class="form-group">
                                        <select class="form-control" name="trangthai">
                                            <option value="0" @if($cate->status==0) selected @endif>Ẩn</option>
                                            <option value="1" @if($cate->status==1) selected @endif>Hiện</option>
                                            
                                    </div>
                                    {{csrf_field()}}
                                    @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button>@endif
                                </form>
                                </td>
                               <td>
                                  <?php 
                                  $loais=DB::table('type')->where('idCate',$cate->idCate)->get();
                                  $kq=0;
                                    foreach($loais as $loai){
                                        $books=DB::table('books')->where('idType',$loai->idType)->get();
                                        foreach($books as $book){
                                            $kq=$kq+$book->quantity;
                                        } 
                                    }
                                  ?>
                                  {{$kq}}
                               </td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($cate->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($cate->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1)<td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/danh-muc/xoa/'.$cate->idCate)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/danh-muc/sua/'.$cate->idCate)}}">Edit</a></td>
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
