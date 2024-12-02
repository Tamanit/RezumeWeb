@extends('person.layout')

@section('body__wrapper')
    <div class="resumes">
        @include('person.block.resume', ['user' => $user])
    </div>
@endsection
