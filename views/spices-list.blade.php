@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Специи:
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Префикс</th>
            <th>Дата</th>
            <th>Статус</th>
            <th></th>
            <th></th>
            </thead>
            <tbody>
            @foreach($spices as $spice)
                <tr>

                    <td>{{$spice->number}}</td>
                    <td>{{$spice->prefix}}</td>
                    <td>{{$spice->date}}</td>

                    @if ($spice->close)

                        <td>Завершено</td>
                        <td></td>
                        <td><a href="{{Route("spices-list-doc",['id' => $spice->id] )}}"><span
                                        class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Спиок документов</a></td>
                    @else
                        <td>
                            В работе
                        </td>
                        <td>
                            <form class="form-horizontal" action="{{Route("spice-close")}}" method="POST">
                                <input type="hidden" name="id" value="{{$spice->id}}">
                                <button type="submit" class="btn btn-warning"><span
                                            class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Завершить
                                </button>
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                            </form>
                        </td>
                        <td>

                            <a href="{{Route("spices-list-doc",['id' => $spice->id] )}}"><span
                                        class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Спиок документов</a>

                            @if($spice->docSpice->isEmpty())
                            <form class="form-horizontal" action="{{Route("spice-delete")}}" method="POST">
                                <input type="hidden" name="id" value="{{$spice->id}}">
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
