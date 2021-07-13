@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Danh mục
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                        
                            <?php $message= session::get('message');  
                            $item = Session::get('item');
                                Session::put('message',null)
                            ?>
                            @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                            
                            @endif
                            <a href="{{URL::to('admin/danh-muc/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/danh-muc/sua/'.$item->idCate)}}" method="POST">
                        
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input class="form-control" name="txtCateName" placeholder="Nhập tên danh mục" value="{{$item->nameCate}}" required/>
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select class="form-control" name="status">
                                  @if($item->status==1)
                                    <option value="1" selected>Hiện</option>
                                    <option value="0">Ẩn</option>
                                  
                                  @else
                                    <option value="1" >Hiện</option>
                                    <option value="0" selected>Ẩn</option>
                                  
                                @endif
                                   
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Lưu</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection