@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Цены маршрута: <br>
        <a class="btn btn-success" href="{{Route("route-price-add",
                                             [
                                                 'route_contractor_id' => $_GET['id']
                                             ])}}">Добавить цены маршрута</a>
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>От</th>
            <th>До</th>
            <th>ед.изм</th>
            <th>Цена</th>

            </thead>
            <tbody>
            <?php foreach ($routePrices as $routePrice){ ?>
            <tr>
                <td>{{$routePrice->id}}</td>
                <td>{{$routePrice->ot}}</td>
                <td>{{$routePrice->do}}</td>
                <td>{{$routePrice->unit->name}}</td>
                <td>{{$routePrice->price}}</td>
                <td>
                    <form class="form-horizontal" action="{{Route("route-price-delete")}}" method="POST">
                        <input type="hidden" name="id" value="{{$routePrice->id}}">
                        <input type="hidden" name="route_contractor_id" value="{{$_GET['id']}}">
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
