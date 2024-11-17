<div class="data">
    <table>
        <tr>@foreach($data['titles'] as $title)<th>{{$title}}</th>@endforeach</tr>
        @foreach($data['values'] as $values)
            <tr>
                @if(is_array($values))
                    @foreach($values as $value)
                        <td>{{$value}}</td>
                    @endforeach
                @else
                    <td>{{$values}}</td>
                @endif
            </tr>
        @endforeach
    </table>
</div>
