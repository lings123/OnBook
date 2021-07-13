@extends('admin.layout.master')
@section('content')
   <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hình thức thanh toán
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Hình thức thanh toán</th>
                                <th>Mô tả</th>
                                <th>Ngày thêm</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1)<th>Delete</th>
                                <th>Edit</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listCheck as $Check)
                            <tr class="odd gradeX" align="center">
                                <td>{{$Check->nameCheck}}</td>
                            
                               <td>
                                {!!$Check->noidung!!}
                             </td>
                               <td>
                              
                                {{ \Carbon\Carbon::parse($Check->create_date)->format('d/m/Y H:i:s')}}</td>
                               <td>{{ \Carbon\Carbon::parse($Check->update_date)->format('d/m/Y H:i:s')}}</td>
                               @if(Session::get('level')==1) <td class="center"><i class="fa fa-trash-o fa-fw "></i><a href="{{URL::to('admin/thanh-toan/xoa/'.$Check->idCheck)}}" class='btn-del'> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/thanh-toan/sua/'.$Check->idCheck)}}">Edit</a></td>
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
