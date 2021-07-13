<?php  
$listtype=Session::get('type') ; 
$listAu=Session::get('author');
$listPub=Session::get('publisher');
$listTop=DB::table('books')->orderBy('diem','DESC')->limit(10)->get();

?>

<div class="shop__sidebar">
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">TOP 10 BOOKS BY REVIEW</h3>
        <ul><?php $stt=0; ?>
            @foreach($listTop as $top)
            <li><span class="badge "> {{++$stt}}</span><a href="{{URL::to('/chi-tiet/'.$top->slug_name)}}">{{$top->NameBook}}</a></li>
            @endforeach
            
        </ul>
    </aside>
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Tình trạng</h3>
        <ul>
            <li><a href="{{URL::to('/tinh-trang/new')}}" >NEW<span></a></li>
            <li><a href="{{URL::to('/tinh-trang/sale')}}">SALE<span></a></li>
        </ul>
    </aside>

    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Thể loại sách</h3>
        <ul>
            @foreach($listtype as $type)
            <li><a href="{{URL::to('/the-loai/'.$type->idType)}}">{{$type->nameType}}<span>
                <?php $book=DB::table('books')->where('idType',$type->idType)->count(); ?>
                ({{$book}})</span></a>
            </li>
            @endforeach
            
        </ul>
    </aside>
    <aside class="wedget__categories poroduct--cat">
        <h3 class="wedget__title">Nhà xuất bản</h3>
        <ul>
            @foreach($listPub as $Pub)
            <li><a href="{{URL::to('/nha-xuat-ban/'.$Pub->idPub)}}">{{$Pub->namePub}}</li>
            @endforeach
        </ul>
    </aside>

</div>