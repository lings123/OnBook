@extends('admin.layout.master')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Hình </th>
                                <th>Tên sách</th>
                                <th>Thể loại</th>
                                <th>Tác giả</th>
                                <th>Nhà xuất bản</th>
                                <th>Đơn giá</th>
                                <th>Giá khuyến mãi</th>
                                <th>Số lượng</th>
                                @if(Session::get('level')==1) <th>Cập nhật</th>@endif
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                @if(Session::get('level')==1) <th>Delete</th>
                                <th>Edit</th> @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listBook as $product)
                            <tr class="odd gradeX" align="center">
                                <td><img src="{{URL::to('public/uploaded/books/'.$product->hinh_dai_dien)}}" width="150px" height="250px" style="border-radius: 4px"></td>
                                <td>{{$product->NameBook}}</td>
                                <td>
                                    <?php $Type=DB::table('type')->where('idType',$product->idType)->first() ?>   
                                    {{$Type->nameType}}
                                </td>
                                <td>
                                    <?php $author=DB::table('author')->where('idAuthor',$product->idAuthor)->first() ?>   
                                    {{$author->nameAuthor}}
                                </td>
                                <td>
                                    <?php $Pub=DB::table('Publisher')->where('idPub',$product->idPub)->first() ?>   
                                    {{$Pub->namePub}}
                                </td>
                                <td>{{$product->unit_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                <td>{{$product->quantity}}</td>
                                @if(Session::get('level')==1) <form action="{{URL::to('admin/san-pham/cap-nhat/'.$product->idBook)}}" method="POST">
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" name="txtQty" type="text" value="0" placeholder="Cập nhật số lượng"/>
                                        </div>
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-default">Cập nhật</button>
                                    </td>
                                   
                                </form>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($product->create_date)->format('d/m/Y H:i:s')}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->update_date)->format('d/m/Y H:i:s')}}</td>    
                                @if(Session::get('level')==1)  <td class="center"  ><i class="fa fa-trash-o fa-fw"></i> <a href="{{URL::to('admin/san-pham/xoa/'.$product->idBook)}}"  >Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{URL::to('admin/san-pham/sua/'.$product->idBook)}}">Sửa</a></td>
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
        <!-- /#page-wrapper -->
@endsection
