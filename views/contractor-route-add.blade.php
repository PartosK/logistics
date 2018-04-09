@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить направление у контрагента:
        <?php foreach ($contractors as $contractor){ ?>
        {{ $contractor->name}}
        <?php } ?>

        <form class="form-horizontal" method="POST" action="{{Route("contractor-route-add")}}">

        <div class="form-group">
            <label  class="col-sm-2 control-label">Откуда</label>
            <div class="col-sm-10">
                <select class="form-control" name="from" >
                    <?php foreach ($cities as $town){ ?>
                    <option value="{{$town->id}}" >{{$town->name}}</option>
                        <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label  class="col-sm-2 control-label">Куда</label>
            <div class="col-sm-10">
                <select class="form-control" name="in">
                    <?php foreach ($cities as $town){ ?>
                    <option value="{{$town->id}}" >{{$town->name}}</option>
                    <?php } ?>
                </select>
            </div>
        </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="contractor_id" value=" {{$contractor->id}}" />

 </form>
    </div>
    @endsection
