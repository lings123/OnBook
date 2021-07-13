@extends('admin.layout.master')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slider
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Tên hình ảnh</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Sliders as $slider)
                            <tr class="odd gradeX" align="center">
                                <td><img src="{{URL::to('public/uploaded/slider/'.$slider->nameSlider)}}" style="border-radius: 4px; width:250px;height:150px"></td>
                                <td>{!!$slider->mota!!}</td>
                                <td>{{ \Carbon\Carbon::parse($slider->create_date)->format('d/m/Y H:i:s')}}</td>
                                <td>{{ \Carbon\Carbon::parse($slider->update_date)->format('d/m/Y H:i:s')}}</td> 
                                @if(Session::get('level')==1)<td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="admin/slider/xoa/{{$slider->idSlider}}"  >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slider/sua/{{$slider->idSlider}}">Sửa</a></td>
                                @endif
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
                <!-- Button trigger modal -->
               

                

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection