<!doctype html>
<html>
@include('share.block.header')
<body>
<section class="body__wrapper">
    @include('share.block.menu')
    @yield('body__wrapper')
</section>
</body>
@include('share.block.footer')
</html>
