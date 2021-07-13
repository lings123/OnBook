
<div class="wn__sidebar">
    <!-- Start Single Widget -->
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>
        <form action="{{URL::to('/blog/tim-kiem')}}" method="GET">
            <div class="form-input">
                <input type="text" name="keyword" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget recent_widget">
        <h3 class="widget-title">Recent</h3>
        <div class="recent-posts">
            <ul>
                @if($recent)
                @foreach($recent as $post)
                <li>
                    <div class="post-wrapper d-flex">
                        
                        <div class="content">
                            <h4><a href="{{URL('/blog/chi-tiet/'.$post->slug_name)}}">{{$post->tieude}}</a></h4>
                            <p>{{ \Carbon\Carbon::parse($post->create_date)->format('d/m/Y H:i:s')}}</p>
                        </div>
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </aside>
    <!-- End Single Widget -->
    
</div>