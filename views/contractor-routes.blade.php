@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Маршруты контрагента: <br>
        <a class="btn btn-success" href="{{Route("contractor-route-add",
                                             [
                                                 'contractor_id' => $_GET['id']
                                             ])}}">Добавить маршрут контрагенту</a>
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Откуда</th>
            <th>Куда</th>
            <th>Контрагент</th>
            <th>Цены маршрута</th>
            <th></th>
            </thead>
            <tbody>
            <?php foreach ($routes as $route){ ?>
            <tr>
                <td>{{$route->id}}</td>
                <td>{{$route->city_from->name}}</td>
                <td>{{$route->city_in->name}}</td>
                <td>{{$route->contractor->name}}</td>
                <td>
                    @if($route->contractor->total_price_transport){{'Общий прайс'}}

                    @else
                        <a href="{{Route("route-price",['id' => $route->id] )}}"><span
                                    class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                    @endif
                </td>
                <td>
                    <form class="form-horizontal" action="{{Route("contractor-route-delete")}}" method="POST">
                        <input type="hidden" name="id" value="{{$route->id}}">
                        <input type="hidden" name="contractor_id" value="{{$_GET['id']}}">
                        <button type="submit" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-trash" aria-hidden="true"></span> Удалить
                        </button>
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>
    @endsection
