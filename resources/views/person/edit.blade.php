@extends('person.layout')

@section('body__wrapper')
    <div class="resume__add">
        <h2 class="resume__add__label"> Изменение резюме</h2>
        <form class="resume__edit__form" method="POST" enctype=multipart/form-data action="{{route('persons.update', $user->id)}}" data-csrf="{{csrf_token()}} ">
            <div class="resume__add__form__block">
                <label for="fio">ФИО</label>
                <input id="fio" name="FIO" placeholder="______________________________" data-slots="_" data-accept="[\-А-Яа-я a-zA-Z]" value="@if (old('FIO') != null) {{old('FIO')}} @else {{$user->FIO}} @endif"/>
                <ul class="error-block">
                    @error('FIO')
                    <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="fio">Профессия</label>
                <select id="stuff" name="Staff">
                    @foreach($stuff as $staff)
                        <option @if ($user->$stuff == $staff->id) selected @endif value="{{$staff->id}}">{{$staff->staff}}</option>
                    @endforeach
                </select>
                <ul class="error-block">
                    @error('Stuff')
                    <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="phone">Телефон</label>
                <input id="phone" name="Phone" placeholder="+7 (___) ___-__-__" data-slots="_" data-accept="\d" value=" @if (old('Phone') !== null) {{old('Phone')}} @else {{$user->Phone}} @endif"/>
                <ul class="error-block">
                    @error('Phone')
                    <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="stage">Стаж</label>
                <input id="stage" name="Stage" placeholder="___" data-slots="_" data-accept="[0-9]" value="@if (old('Stage') !== null) {{old('Stage')}} @else {{$user->Stage}} @endif"/>
                <ul class="error-block">
                    @error('Stage')
                    <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="image">Аватар</label>
                <input id="image" name="Image" type="file" value="@if (old('Image') !== null) {{old('Image')}} @else {{$user->Image}} @endif"/>
                <ul class="error-block">
                    @error('Image')
                    <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block__submit">
                <button id="submit" type="submit">Изменить</button>
                <input type="hidden" name="_method" value="PUT">
                @csrf
            </div>
        </form>
    </div>
@endsection
