@extends('person.layout')

@section('body__wrapper')
    <div class="resume__add">
        <h2 class="resume__add__label">Добавление нового резюме</h2>
        <form class="resume__add__form" method="POST" enctype=multipart/form-data action="{{route('persons.store')}}">
            <div class="resume__add__form__block">
                <label for="fio">ФИО</label>
                <input id="fio" name="FIO" placeholder="______________________________" data-slots="_" data-accept="[\-А-Яа-я a-zA-Z]" value="{{old('FIO')}}" required/>
                <ul class="error-block">
                    @error('FIO')
                        <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="fio">Профессия</label>
                <select id="stuff" name="Staff" required>
                    @foreach($stuff as $staff)
                        <option value="{{$staff->id}}">{{$staff->staff}}</option>
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
                <input id="phone" name="Phone" placeholder="+7 (___) ___-__-__" data-slots="_" data-accept="\d" value="{{old('Phone')}}" required/>
                <ul class="error-block">
                    @error('Phone')
                            <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="stage">Стаж</label>
                <input id="stage" name="Stage" placeholder="___" data-slots="_" data-accept="[1-9][0-9][0-9]" value="{{old('Stage')}}" required/>
                <ul class="error-block">
                    @error('Stage')
                            <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="image">Аватар</label>
                <input id="image" name="Image" type="file" required value="{{old('Image')}}"/>
                <ul class="error-block">
                    @error('Image')
                            <li class="error-block__element">{{$message}}</li>
                    @enderror
                </ul>
            </div>
            <div class="resume__add__form__block__submit">
                <button id="submit" type="submit">Добавить</button>
                @csrf
            </div>
        </form>
    </div>
@endsection
