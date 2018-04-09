@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить контрагента
        <form class="form-horizontal" action="{{Route("contractor-save")}}" method="POST">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                    <input readonly class="form-control" id="id" name="id" placeholder="ID" value="{{$contractor->id}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <input class="form-control" id="name" name="name" placeholder="Наименование" value="{{$contractor->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ИНН</label>
                <div class="col-sm-10">
                    <input class="form-control" id="inn" name="inn" placeholder="ИНН" value="{{$contractor->inn}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Счет</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="account" name="account" placeholder="Счет" value="{{$contractor->account}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Телефон</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="phone" name="phone" placeholder="Телефон" value="{{$contractor->phone}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Почта</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Почта" value="{{$contractor->email}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Плотность</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="density" name="density" placeholder="Плотность" value="{{$contractor->density}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Тоннаж одного веса:</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="ton_one_weight" name="ton_one_weight" placeholder="Тоннаж одного веса" value="{{$contractor->ton_one_weight}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Габарит одного места:</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="ton_one_place" name="ton_one_place" placeholder="Габарит одного места" value="{{$contractor->ton_one_place}}">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Только по кубам</label>
                <div class="col-sm-10">
                    <label>
                        <input type="checkbox" name="onlycube" id="onlycube" value="1" @if($contractor->onlycube){{'checked'}} @endif >
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Расчет</label>
                <div class="col-sm-10">
                    <label>
                        <input type="checkbox" name="payment_cash" value="1" @if($contractor->payment_cash){{'checked'}} @endif> Наличные
                    </label>
                    <label>
                        <input type="checkbox" name="payment_bank" value="1" @if($contractor->payment_bank){{'checked'}} @endif> Безналичные
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Общий прайс</label>
                <div class="col-sm-10">
                    <label>
                        <input type="checkbox" name="total_price_transport" @if($contractor->total_price_transport){{'checked'}} @endif" value="1">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </form>
    </div>
    @endsection
