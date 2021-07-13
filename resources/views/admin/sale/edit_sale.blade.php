@extends('admin.layout.master')
@section('content')
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khuyến mãi
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <div class="col-lg-7" style="padding-bottom:120px">
                        
                            <?php $message= session::get('message'); 
                             $sale = Session::get('sale');
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
                        <form action="{{URL::to('admin/khuyen-mai/sua/'.$sale->idSale)}}" method="POST">
                        
                            <div class="form-group">
                                <label>Mã khuyến mãi</label>
                                <input class="form-control" name="txtSaleName" placeholder="Nhập mã khuyến mãi" value="{{$sale->nameSale}}" required/>
                            </div>

                            <div class="form-group">
                                <label>Phần trăm khuyến mãi</label>
                                <select class="form-control" name="Phantram">
                                    
                                    @for($i=1;$i<=5;$i++)
                                        <option value="{{$i/10}}" @if($i/10==$sale->phantram) selected @endif>{{$i*10}} %</option>
                                    @endfor
                               </select>
                            </div> 

                            <div class="form-group">
                                <label>Active</label>
                                <select class="form-control" name="status">
                                    <option value="1" @if($sale->active==1) selected @endif>Hiện</option>
                                    <option value="0" @if($sale->active==0) selected @endif>Ẩn </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Số lần áp dụng</label>
                                <input class="form-control" name="txtSolan" type="number" max="10"  value="{{$sale->solan}}" required/>
                            </div> 

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control ckeditor" rows="4" id="editor1" type="text" name="txtDescription" >{!!$sale->mota!!}</textarea>
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