<section class="menu">
    @foreach($menuButtons as $btn)
        <a class="menu__block" href="{{asset($btn['link'])}}">{{$btn['title']}}</a>
    @endforeach
</section>
