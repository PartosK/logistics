@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить автомобиль
        <form class="form-horizontal"  action="{{Route("spice-add")}}" method="POST">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Номер</label>
                <div class="col-sm-10">
                    <input class="form-control" id="number" name="number" placeholder="Номер" value="{{ old('number') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Префикс</label>
                <div class="col-sm-10">
                    <input class="form-control" id="prefix" name="prefix" placeholder="Префикс" value="{{ old('prefix') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Дата</label>
                <div class="col-sm-10">
                    <input class="form-control" id="datereading" name="date" placeholder="Дата" value="{{ date('d-m-Y') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </form>

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                </ul>
            </div>

        @endif
    </div>
    <script>
        $(function(){

            $('#datereading').datetimepicker({
                format: 'DD-MM-YYYY',
                locale: 'ru'
            });

        });

    </script>
    @endsection
