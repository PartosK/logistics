@extends('layouts.template')

@section('content')

    <div class="col-md-9">
        Добавить цену по направлению общего прайса:

        <form class="form-horizontal" method="POST" action="{{Route("route-price-all-add")}}">


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
            <label  class="col-sm-2 control-label">Тип единицы</label>
            <div class="col-sm-10">
                <select class="form-control" name="unit">
                    <?php foreach ($units as $unit){ ?>
                    <option value="{{$unit->id}}" >{{$unit->name}}</option>
                    <?php } ?>
                </select>
            </div>
        </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">От</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="ot" name="ot" placeholder="От" value="0" type="number" min="0" step="any">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">До</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="do" name="do" placeholder="До" type="number" step="any">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">Цена</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="price" name="price" placeholder="цена">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}" />


 </form>
    </div>
    @endsection
