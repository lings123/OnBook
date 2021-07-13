@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khuyến mãi
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                        
                            <?php
                            $message=Session::get('message');
                            Session::put('message',null);    
                        ?>
                         @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                        @endif
                        <a href="{{URL::to('admin/khuyen-mai/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/khuyen-mai/them')}}" method="POST">
                            
                            <div class="form-group">
                                <label>Mã khuyến mãi</label>
                                <input class="form-control" name="txtSaleName" placeholder="Nhập tên khuyến mãi" value="{!! old('txtSaleName')!!}" required/>
                            </div> 

                            <div class="form-group">
                                <label>Phần trăm khuyến mãi</label>
                                <select class="form-control" name="Phantram" required>
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{$i/10}}">{{$i*10}} %</option>
                                    @endfor
                               </select>
                            </div> 
                            
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Số lần áp dụng</label>
                                <input class="form-control" name="txtSolan" type="number" max="10"  value="{!! old('txtSolan')!!}" required/>
                            </div> 

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="4" id="editor1" type="text" name="txtDescription" ></textarea>
                            </div> 

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection