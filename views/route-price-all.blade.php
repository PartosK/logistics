@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        <table class="table table-bordered">
            <thead>
            <th>№</th>
            <th>Откуда</th>
            <th>Куда</th>
            <th>От</th>
            <th>До</th>
            <th>ед.изм</th>
            <th>Цена</th>

            </thead>
            <tbody>
            <?php  foreach ($routePricesAll as $routePrice){ ?>
            <tr>
                <td>{{$routePrice->id}}</td>
                <td>{{$routePrice->city_from->name}}</td>
                <td>{{$routePrice->city_in->name}}</td>
                <td>{{$routePrice->ot}}</td>
                <td>{{$routePrice->do}}</td>
                <td>{{$routePrice->unit->name}}</td>
                <td>{{$routePrice->price}}</td>
                <td>
                    <form class="form-horizontal" action="{{Route("route-price-all-delete")}}" method="POST">
                        <input type="hidden" name="id" value="{{$routePrice->id}}">

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
