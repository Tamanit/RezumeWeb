<div class="resumes">
    @foreach($datas as $name => $data)
        <div class="resumes__user-block">
            <div class="resumes__user-block__string-data">
            <span class="resumes__user-block__text-attribute resumes__user-block__text-attribute__fio">
                {{$name}}: {{$data}}
            </span>
            </div>
        </div>
    @endforeach
</div>
