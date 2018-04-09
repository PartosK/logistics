@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Фирмы:
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Наименование</th>
            <th>Адрес</th>
            <th>ИНН</th>
            <th>КПП</th>
            <th>Счет</th>
            <th>Телефон</th>
            <th>Директор</th>
            <th>Бухгалтер</th>
            <th>Банк</th>
            <th>БИК Банка</th>
            <th>Счет Банка</th>
            <th></th>
            </thead>
            <tbody>
            @foreach($firms as $firm)
            <tr>
                <td>{{$firm->id}}</td>
                <td>{{$firm->name}}</td>
                <td>{{$firm->address}}</td>
                <td>{{$firm->inn}}</td>
                <td>{{$firm->kpp}}</td>
                <td>{{$firm->account}}</td>
                <td>{{$firm->phone}}</td>
                <td>{{$firm->director}}</td>
                <td>{{$firm->buh}}</td>
                <td>{{$firm->namebank}}</td>
                <td>{{$firm->bikbank}}</td>
                <td>{{$firm->accountbank}}</td>
                <td>
                <form class="form-horizontal" action="{{Route("firm-delete")}}" method="POST">
                    <input type="hidden" name="id" value="{{$firm->id}}">
                    <button type="submit" class="btn btn-danger"><span
                                class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                    </button>
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                </form>
                    <a href="{{Route("firm-edit",['id' => $firm->id] )}}"><span
                                class="glyphicon glyphicon-edit" aria-hidden="true"></span> Изменить</a>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>

    </div>
    @endsection
