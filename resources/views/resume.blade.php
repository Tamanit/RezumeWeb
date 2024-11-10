@include('page')
<body>
<div class="resumes">
    @foreach($users as $user)
        <div class="resumes__user-block">
            <div class="resumes__user-block__photo">
                <img
                    class="resumes__user-block__photo__img"
                    src="{{asset('images/' . $user->Image)}}"
                    alt="аватар пользователя вкансии"
                />
            </div>
            <div class="resumes__user-block__string-data">
                <span
                    class="resumes__user-block__text-attribute resumes__user-block__text-attribute__fio">Фамилия: {{$user->FIO}}</span>
                <span
                    class="resumes__user-block__text-attribute resumes__user-block__text-attribute__job">Профессия: {{$user->Staff}}</span>
                <span
                    class="resumes__user-block__text-attribute resumes__user-block__text-attribute__phone">Телефон: {{$user->Phone}}</span>
                <span
                    class="resumes__user-block__text-attribute resumes__user-block__text-attribute__stage">Стаж: {{$user->Stage}}</span>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
