@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Фирмы:
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Наименование</th>
            <th>Контрагент</th>
            </thead>
            <tbody>
            @foreach($senders as $sender)
            <tr>
                <td>{{$sender->id}}</td>
                <td>{{$sender->name}}</td>
                <td>{{$sender->contractor->name}}</td>
                <td>
                    <form class="form-horizontal" action="{{Route("sender-delete")}}" method="POST">
                        <input type="hidden" name="id" value="{{$sender->id}}">
                        <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                        </button>
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>

        </table>

    </div>
    @endsection
