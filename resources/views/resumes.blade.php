@include('block.share.header')
<div class="body__wrapper">
    @include('block.share.menu')
    <div class="resumes">
        @foreach($resumes as $user)
            @include('block.resume.resume', ['user' => $user])
        @endforeach
    </div>
</div>
@include('block.share.footer')
