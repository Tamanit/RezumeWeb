@extends('person.layout')

@section('body__wrapper')
    <div class="resumes">
        @foreach($resumes as $user)
            @include('person.block.resume', ['user' => $user])
        @endforeach
    </div>
@endsection
