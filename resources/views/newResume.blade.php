@include('block.share.header')
<div class="body__wrapper">
    @include('block.share.menu')
    <div class="resume__add">
        <h2 class="resume__add__label">Добавление нового резюме</h2>
        <form class="resume__add__form" method="POST" enctype=multipart/form-data>
            <div class="resume__add__form__block">
                <label for="fio">ФИО</label>
                <input id="fio" name="fio" placeholder="______________________________" data-slots="_" data-accept="[\-А-Яа-я a-zA-Z]" @if(!empty($data) && isset($data['fio']))value="{{$data['fio']}}" @endif required/>
                <ul class="error-block">
                    @if(!empty($error) && key_exists('fio', $error))
                        @foreach($error['fio'] as $errorString)
                            <li class="error-block__element">{{$errorString}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="fio">Профессия</label>
                <select id="stuff" name="stuff" required>
                    @foreach($stuff as $stuffElement)
                        <option @if(!empty($data) && isset($data['stuff']) && $data['stuff'] == $stuffElement->id) selected @endif value="{{$stuffElement->id}}">{{$stuffElement->staff}}</option>
                    @endforeach
                </select>
                <ul class="error-block">
                    @if(!empty($error) && key_exists('stuff', $error))
                        @foreach($error['stuff'] as $errorString)
                            <li class="error-block__element">{{$errorString}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="phone">Телефон</label>
                <input id="phone" name="phone" placeholder="+7 (___) ___-__-__" data-slots="_" data-accept="\d" @if(!empty($data) && isset($data['phone']))value="{{$data['phone']}}"@endif required/>
                <ul class="error-block">
                    @if(!empty($error) && key_exists('phone', $error))
                        @foreach($error['phone'] as $errorString)
                            <li class="error-block__element">{{$errorString}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="stage">Стаж</label>
                <input id="stage" name="stage" placeholder="___" data-slots="_" data-accept="[1-9]" @if(!empty($data) && isset($data['stage']))value="{{$data['stage']}}"@endif required/>
                <ul class="error-block">
                    @if(!empty($error) && key_exists('stage', $error))
                        @foreach($error['stage'] as $errorString)
                            <li class="error-block__element">{{$errorString}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="resume__add__form__block">
                <label for="image">Аватар</label>
                <input id="image" name="image" type="file" required/>
                <ul class="error-block">
                    @if(!empty($error) && key_exists('image', $error))
                        @foreach($error['image'] as $errorString)
                            <li class="error-block__element">{{$errorString}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="resume__add__form__block__submit">
                <button id="submit" type="submit">Добавить</button>
                @csrf
            </div>
        </form>
    </div>
</div>
@include('block.share.footer')
