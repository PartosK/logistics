@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Контрагенты:
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Наименование</th>
            <th>ИНН</th>
            <th>Телефон</th>
            <th>Почта</th>
            <th>Счет</th>
            <th>Плотность</th>
            <th>Тоннаж одного веса</th>
            <th>Габарит одного места</th>
            <th>Только по кубам</th>
            <th>Наличные</th>
            <th>Безналичные</th>
            <th>Маршруты</th>
            <th></th>
            </thead>
            <tbody>
            <?php foreach ($contractors as $contractor){ ?>
            <tr>
                <td>{{$contractor->id}}</td>
                <td>{{$contractor->name}}</td>
                <td>{{$contractor->inn}}</td>
                <td>{{$contractor->phone}}</td>
                <td>{{$contractor->email}}</td>
                <td>{{$contractor->account}}</td>
                <td>{{$contractor->density}}</td>
                <td>{{$contractor->ton_one_weight}}</td>
                <td>{{$contractor->ton_one_place}}</td>
                <td>@if($contractor->onlycube){{'Да'}}@endif</td>
                <td>@if($contractor->payment_cash){{'Да'}}@endif</td>
                <td>@if($contractor->payment_bank){{'Да'}}@endif</td>
                <td>
                    <a href="{{Route("contractor-routes",['id' => $contractor->id] )}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                </td>
           <td>
               <form class="form-horizontal" action="{{Route("contractor-delete")}}" method="POST">
                   <input type="hidden" name="id" value="{{$contractor->id}}">
                   <button type="submit" class="btn btn-danger"><span
                               class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                   </button>
                   {{ method_field('DELETE') }}
                   {{ csrf_field() }}
               </form>
               <a href="{{Route("contractor-edit",['id' => $contractor->id] )}}"><span
                           class="glyphicon glyphicon-edit" aria-hidden="true"></span> Изменить</a>
           </td>
            </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
    @endsection
