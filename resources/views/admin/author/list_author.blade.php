@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tác giả
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên tác giả</th>
                                <th>Giới tính</th>
                                <th>Giới thiệu</th>
                                <th>Số sản phẩm</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listAuthor as $author)
                            <tr class="odd gradeX" align="center">
                                <td>{{$author->nameAuthor}}</td>
                                
                                    @if($author->gioitinh_author==1)
                                        <td>Nam</td>
                                    
                                    @else
                                       <td> Nữ</td>
                                    
                                    @endif
                                
                               <td>
                                  {!!$author->desc_author!!}
                               </td>
                               <td><?php $books=DB::table('books')->where('idAuthor',$author->idAuthor)->get() ?>{{$books->count()}}</td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($author->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($author->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1) <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/tac-gia/xoa/'.$author->idAuthor)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/tac-gia/sua/'.$author->idAuthor)}}">Edit</a></td>
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
