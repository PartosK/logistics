@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Специи:
        <table class="table table-bordered">
            <thead>
            <th>ID</th>
            <th>Дата</th>
            <th>Текст</th>
            <th>Сумма претензии</th>
            <th>Остаток</th>
            <th>Контрагент</th>
            <th>Статус</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($pretensions as $pretension)
                <tr>

                    <td>{{$pretension->id}}</td>
                    <td>{{$pretension->date}}</td>
                    <td>{{$pretension->text}}</td>
                    <td>{{$pretension->price}}</td>
                    <td>{{$pretension->ostatok}}</td>
                    <td>{{$pretension->contractor->name}}</td>
                    @if ($pretension->close)
                        <td>Завершено</td>
                        <td></td>
                        @else
                        <td>
                            В работе
                        </td>
                        <td>
                            <form class="form-horizontal" action="{{Route("pretension-close")}}" method="POST">
                                <input type="hidden" name="id" value="{{$pretension->id}}">
                                <button type="submit" class="btn btn-warning"><span
                                            class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>Завершить</button>
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                {{ method_field('PUT') }}
                            </form>
                            @if($pretension->price == $pretension->ostatok)
                                <form class="form-horizontal" action="{{Route("pretension-delete")}}" method="POST">
                                    <input type="hidden" name="id" value="{{$pretension->id}}">
                                    <button type="submit" class="btn btn-danger"><span
                                                class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                                    </button>
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </td>
                        @endif
                </tr>



            @endforeach
            </tbody>

</table>
</div>
@endsection
