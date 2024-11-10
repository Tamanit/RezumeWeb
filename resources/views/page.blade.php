<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$header}}</title>
    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<header class="header">
    <h1 class="header__title">{{$header}}</h1>
</header>
<body>
<div class="body-block">
    <div class="body-block__left-part">@include('block.menu')</div>
    <div class="body-block__right-part">
        @switch($_SERVER['REQUEST_URI'])
            @case('/show')
            @case('/stage-5-to-15')
            @case('/it-guy')
                @include('block.resume')
                @break
            @case('/resume-count')
            @case('/active-staff')
                @include('block.data')
                @break
        @endswitch
    </div>
</div>
</body>
</html>
