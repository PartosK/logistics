@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        @if(Session::has('email'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('email')}}
            </div>
        @endif
        Фирмы:
        <table class="table table-bordered">
            <thead>
            <th>ID</th>
            <th>Дата</th>
            <th>Номер</th>
            <th>Специя</th>
            <th>Контрагент</th>
            <th>Откуда</th>
            <th>Куда</th>
            <th>Расчет</th>
            <th>Итого (руб.)</th>
            <th></th>
            </thead>
            <tbody>

            @foreach($docs as $doc)
                <tr>
                    <td>{{$doc->id}}</td>
                    <td>{{$doc->date}}</td>
                    <td>{{$doc->number}}</td>
                    <td>{{$doc->spice->prefix}}{{$doc->spice->number}}</td>
                    <td>{{$doc->contractor->name}}</td>
                    <td>{{$doc->route_contractors->city_from->name}}</td>
                    <td>{{$doc->route_contractors->city_in->name}}</td>
                    <td>{{$doc->doc_type->name}}</td>
                    <td>{{$doc->total_price}}</td>
                    <td>
                        @if ($doc->doc_type_id == 1)
                            <a href="{{Route("doc-bank",['id' => $doc->id] )}}"><span
                                        class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>

                        @else
                            <a href="{{Route("doc-cash",['id' => $doc->id] )}}"><span
                                        class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></a>
                        @endif
                    </td>
                    <td>
                        <a target="_blank" href="{{Route("doc-word",['id' => $doc->id] )}}"><span
                                    class="glyphicon glyphicon-save-file" aria-hidden="true"></span></a>
                    </td>
                    <td>
                        <a href="{{Route("doc-word-email",['id' => $doc->id] )}}"><span
                                    class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a>
                    </td>
                    <td>
                        @if(!$doc->spice->close)
                        <form class="form-horizontal" action="{{Route("doc-delete")}}" method="POST">
                            <input type="hidden" name="id" value="{{$doc->id}}">
                            <button type="submit" class="btn btn-danger"><span
                                        class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                        </form>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>

    @endsection
