
@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Loại sách</th>
                                <th>Danh mục</th>
                                <th>Mô tả</th>
                                <th>Hiển thị</th>
                                <th>Số sản phẩm</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1)<th>Delete</th>
                                <th>Edit</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listType as $Type)
                            <tr class="odd gradeX" align="center">
                                <td>{{$Type->nameType}}</td>
                                <?php 
                                    $cate=DB::table('category')->where('idCate',$Type->idCate)->first();
                                    
                                    ?>
                               <td>
                                   {{$cate->nameCate}}
                               </td>
                               <td>
                                {!!$Type->mota!!}
                             </td>
                             <td>
                                <form action="{{URL::to('admin/loai-sach/cap-nhat/'.$Type->idType)}}" method="POST">
                                    <div class="form-group">
                                        <select class="form-control" name="trangthai">
                                            <option value="0" @if($Type->status==0) selected @endif>Ẩn</option>
                                            <option value="1" @if($Type->status==1) selected @endif>Hiện</option>
                                            
                                    </div>
                                    {{csrf_field()}}
                                    @if(Session::get('level')==1)<button type="submit" class="btn btn-default">Cập nhật</button>@endif
                                </form>
                            </td>
                            <td><?php $books=DB::table('books')->where('idType',$Type->idType)->get() ?>{{$books->count()}}</td>
                               <td> {{ \Carbon\Carbon::parse($Type->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($Type->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1)<td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/loai-sach/xoa/'.$Type->idType)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/loai-sach/sua/'.$Type->idType)}}">Edit</a></td>
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

