@if ($numberVideos > 0)
    <div class="col-md-12 top-video">
        <div class="row">
            <div class="col-md-12">
                <div class="carousel slide multi-item-carousel" id="theCarousel">
                    <div class="carousel-inner">
                        
                        @foreach ($videos as $video)
                            @if ($loop->first)
                                <div class="item active">
                                    <div class="col-md-4">
                                        <iframe class="frame-border small-video" src="{{ $video->stream_link }}"  allowfullscreen>
                                        </iframe>
                                        <a href="{{ route('video', $video->id) }}">
                                            <center>
                                                {{ $video->caption }}
                                            </center>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="item">
                                    <div class="col-md-4">
                                        <iframe class="frame-border small-video" src="{{ $video->stream_link }}" allowfullscreen>
                                        </iframe>
                                        <a href="{{ route('video', $video->id) }}">
                                            <center>
                                                {{ $video->caption }}
                                            </center>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                    </div>
                    <a class="left carousel-control" href="#theCarousel" data-slide="prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                    </a>
                    <a class="right carousel-control" href="#theCarousel" data-slide="next">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div> 
@endif 
<hr>
