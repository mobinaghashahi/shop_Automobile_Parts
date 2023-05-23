<div class="academyit1 col-12">
    @foreach($slideShows as $slideShow)
    <div class="mySlides fade">
        <div class="academyit2">{{$loop->index+1}} / {{$slideShows->count()}}</div>
        <img src="slideshow/{{$slideShow->name}}?v=1.1" alt="slide One" style="width:100%">
    </div>
    @endforeach
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
