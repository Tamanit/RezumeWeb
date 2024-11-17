<div class="menu">
    @foreach($menuButtons as $title => $link)
        <a class="menu__block" href="{{asset($link)}}">{{$title}}</a>
    @endforeach
</div>
