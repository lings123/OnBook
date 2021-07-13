@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hình thức thanh toán
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                        
                            <?php $message= session::get('message'); 
                            $Check = Session::get('Check');
                                Session::put('message',null)
                            ?>
                            @if($message)
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{$message}}
                            </div>
                            
                            @endif
                     
                    <a href="{{URL::to('admin/thanh-toan/danh-sach')}}" class="btn btn-default">Trở về</a>
                        <form action="{{URL::to('admin/thanh-toan/sua/'.$Check->idCheck)}}" method="POST">
                        
                            <div class="form-group">
                                <label>Mã khuyến mãi</label>
                                <input class="form-control" name="txtCheckName" placeholder="Nhập mã khuyến mãi" value="{{$Check->nameCheck}}" required/>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="4" id="editor1" type="text" name="txtDescription" >{!!$Check->noidung!!}</textarea>
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