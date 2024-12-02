<div class="resume">
    @if (isset($user->Image))
        <div class="resume__photo">
            <img
                class="resumes__photo__img"
                src="{{asset('images/' . $user->Image)}}"
                alt="аватар пользователя вакансии"
            />
        </div>
    @endif
    <div class="resume__string-data">
        @if(isset($user->FIO))
            <span class="resume__string-data__attribute resume__string-data__attribute__fio">
                Фамилия: {{$user->FIO}}
            </span>
        @endif
        @if(!is_null($user->Staff()) && !is_null($user->Staff()->value('staff')))
            <span class="resume__string-data__attribute resume__string-data__attribute__job">
                Профессия: {{$user->Staff()->value('staff')}}
            </span>
        @endif
        @if(!is_null($user->getMaskedPhone()))
            <span class="resume__string-data__attribute resume__string-data__attribute__phone">
                Телефон: {{$user->getMaskedPhone()}}
            </span>
        @endif
        @if(!is_null($user->getFormatedStage()))
            <span class="resume__string-data__attribute resume__string-data__attribute__stage">
                Стаж: {{$user->getFormatedStage()}}
            </span>
        @endif
    </div>
        <div class="resume__buttons">
            @if($showDetail)
                <a
                    data-csrf="{{csrf_token()}}"
                    href="{{route('persons.show', $user->id)}}"
                    class="resume__buttons__button button__detail"
                >
                    +
                </a>
            @else
                <a data-csrf="{{csrf_token()}}"
                   href="{{route('persons.edit', $user->id)}}"
                   class="resume__buttons__button button__edit"
                >
                    🔧
                </a>
            @endif
            <a data-csrf="{{csrf_token()}}" href="{{route('persons.show', $user->id)}}" class="resume__buttons__button button__delete">x</a>
        </div>
</div>
