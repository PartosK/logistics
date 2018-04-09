@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить фирму
        <form class="form-horizontal" action="{{Route("firm-save")}}" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                    <input readonly class="form-control" id="id" name="id" placeholder="id" value="{{$firm->id}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="name" name="name" placeholder="Наименование"  value="{{$firm->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Адрес</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="address" name="address" placeholder="Адрес"  value="{{$firm->address}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ИНН</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="inn" name="inn" placeholder="ИНН"  value="{{$firm->inn}}">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">КПП</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="kpp" name="kpp" placeholder="КПП"  value="{{$firm->kpp}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Счет</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="account" name="account" placeholder="Счет"  value="{{$firm->account}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Директор</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="director" name="director" placeholder="ФИО"  value="{{$firm->director}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Главный бухгалтер</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="buh" name="buh" placeholder="ФИО"  value="{{$firm->buh}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Телефон</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="phone" name="phone" placeholder="Телефон"  value="{{$firm->phone}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Наименование банка</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="namebank" name="namebank" placeholder="Наименование банка"  value="{{$firm->namebank}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Бик банка</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="bikbank" name="bikbank" placeholder="Бик банка"  value="{{$firm->bikbank}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Счет банка</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="accountbank" name="accountbank" placeholder="Счет банка"  value="{{$firm->accountbank}}">
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
