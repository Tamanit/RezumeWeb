<div class="resumes">
    @foreach($users as $user)
        <div class="resumes__user-block">
            @if (isset($user->Image))
                <div class="resumes__user-block__photo">
                    <img
                        class="resumes__user-block__photo__img"
                        src="{{asset('images/' . $user->Image)}}"
                        alt="аватар пользователя вакансии"
                    />
                </div>
            @endif
            <div class="resumes__user-block__string-data">
                @if(isset($user->FIO))
                    <span class="resumes__user-block__text-attribute resumes__user-block__text-attribute__fio">
                        Фамилия: {{$user->FIO}}
                    </span>
                @endif
                @if(!is_null($user->Staff()) && !is_null($user->Staff()->value('staff')))
                    <span class="resumes__user-block__text-attribute resumes__user-block__text-attribute__job">
                        Профессия: {{$user->Staff()->value('staff')}}
                    </span>
                @endif
                @if(!is_null($user->getMaskedPhone()))
                    <span class="resumes__user-block__text-attribute resumes__user-block__text-attribute__phone">
                        Телефон: {{$user->getMaskedPhone()}}
                    </span>
                @endif
                @if(!is_null($user->getFormatedStage()))
                    <span class="resumes__user-block__text-attribute resumes__user-block__text-attribute__stage">
                        Стаж: {{$user->getFormatedStage()}}
                    </span>
                @endif
            </div>
        </div>
    @endforeach
</div>
