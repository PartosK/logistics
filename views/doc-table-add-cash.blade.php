@extends('layouts.template')

@section('content')
    <div class="col-md-9">

        <table class="table table-bordered" style="margin-bottom: 1px;">
            <tr style="text-align: center">
                <td style="border-style:hidden solid hidden hidden"><b>РАСЧЕ -нал</b></td>
                <td>Номер</td>
                <td><b>{{$number}}</b></td>
                <td><b>{{$date}}</b></td>
                <td>Дата</td>
            </tr>
        </table>
        <table class="table" style="margin-bottom: 1px;">
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5">Плательщик: {{$contractor->name}} ИНН {{$contractor->inn}}</td>
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5">Примечание: СПЕЦИФИКАЦИЯ {{$spice->prefix}} {{$spice->number}}</td>
            </tr>
        </table>
        <button id="addrow" type="button" class="btn btn-default">
        <span class="glyphicon glyphicon-plus" aria-hidden="true">Транспортировка</span>
        </button>

        <button id="addshipping" type="button" class="btn btn-default">
            <span  aria-hidden="true">Доставка</span>
        </button>

        <button id="addzabor" type="button" class="btn btn-default">
            <span  aria-hidden="true">Забор</span>
        </button>

        <button id="addrow" type="button" class="btn btn-default">
            <span  aria-hidden="true">Претензия</span>
        </button>

        <button id="addstation" type="button" class="btn btn-default">
            <span  aria-hidden="true">Заезд на станцию</span>
        </button>

        <button id="addinsurance" type="button" class="btn btn-default">
            <span  aria-hidden="true">Страховка</span>
        </button>

        <button id="addstorage" type="button" class="btn btn-default">
            <span  aria-hidden="true">Хранение на складе</span>
        </button>

        <button id="addporter" type="button" class="btn btn-default">
            <span  aria-hidden="true">Услуга грузчиков</span>
        </button>


        <form class="form-horizontal" action="{{Route("doc-table-add-save")}}" method="POST" onSubmit="return validate_form();">
        <br>
            <div class="form-group">
                <label class="col-sm-2 control-label">Дата выдачи</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="dater_issue" name="date_issue" placeholder="Дата выдачи">
                </div>
            </div>
        <table id="tableuslug" class="table table-bordered" style="margin-bottom: 1px;">

            <thead>
            <tr>
                <th>№</th>
                <th>Предмет счета (наименование услуги)</th>
                <th class="hidden">servicetype</th>
                <th>Направление</th>
                <th>Отправитель</th>
                <th>Транс-<br>портный документ</th>
                <th>Шт.</th>
                <th>Кг.</th>
                <th>м3.</th>
                <th>Единица измерения</th>
                <th>Кол.</th>
                <th>Цена, Руб., коп.</th>
                <th>Сумма, рублей</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr id="1">
                <td class="tdnumber"><input class="form-control" id="trnumber1" name="mass[1][trnumber]" readonly value="1"></td>
                <td><input class="form-control" id="service1" name="mass[1][service]" placeholder="Услуга" value="Организация перевозки груза"></td>
                <td class="hidden" ><input class="form-control" id="servicetype1" name="mass[1][servicetype]" value="1"></td>
                <td><input class="form-control" id="routecontractor1" name="mass[1][routecontractor]" placeholder="Направление" value="{{$routecontractor->city_from->name}}-{{$routecontractor->city_in->name}}"></td>
                <td><input class="form-control sender" id="sender1" name="mass[1][sender]" placeholder="Отправитель"></td>
                <td><input class="form-control" id="requirement1" name="mass[1][requirement]" placeholder="Транспортное"></td>
                <td><input class="form-control ras" id="ht1" name="mass[1][ht]" placeholder="шт"></td>
                <td><input class="form-control ras" id="kg1" name="mass[1][kg]" placeholder="кг"></td>
                <td><input class="form-control ras" id="m31" name="mass[1][m3]" placeholder="м3"></td>
                <td>
                    <select class="form-control ras unit" id="unit1" name="mass[1][unit]">
                        <option value="2">кг.</option>
                        <option value="3">м3.</option>
                    </select>
                </td>
                <td><input class="form-control ras" id="count1" name="mass[1][count]" placeholder="количество"></td>
                <td><input class="form-control ras price" id="price1" name="mass[1][price]" placeholder="Цена"></td>
                <td><input class="form-control total_price_tr" id="total_price_tr1" name="mass[1][total_price_tr]" readonly placeholder="Цена всего"></td>
                <td></td>
            </tr>


            <tr>
                <td colspan="10" style="text-align: right; vertical-align: middle;">ВЕГО К ОПЛАТЕ:</td>
                <td colspan="2" ><input class="form-control total_price" id="total_price" name="total_price" readonly></td>
            </tr>
            </tbody>
        </table>


            <div class="col-md-12" style="text-align: right">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>

            <div class="alert alert-danger" id="error_text" style="display: none"></div>



            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" name="doc_id" value="{{$id}}" />

        </form>
        <input type="hidden" name="contractor_id" d="contractor_id" value="{{$contractor->id}}" />
        <input type="hidden" name="route_contractor_id" id="route_contractor_id" value="{{$routecontractor->id}}" />

    </div>

    <script>
        $(function(){
            $(document).on('keyup change','.ras', function () {
                var tr = $(this).closest('tr');
                var namber = tr.attr("id");
                razhet(namber);
            });

            $(document).on('click','.del', function () {
                var tr = $(this).closest('tr');
                var namber = tr.attr("id");

                var id_pred = namber - 1;
                $('#del'+id_pred).show();

                $('#del'+namber).closest('tr').remove();
                razhet(namber);
            });
        });

        function validate_form ( )
        {

            valid = true;


            if ( $('#total_price').val() == "" )
            {

                $('#error_text').show();
                $('#error_text').text('Пожалуйста заполните документ');
                valid = false;
            }

            return valid;
        }
    </script>

    <script src="{{ URL::asset('js/addTransportation.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/rowCenaTransportation.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addShipping.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addPretension.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addZabor.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addStation.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addInsurance.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addStorage.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/addPorter.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/findSender.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/priceTotal.js')}}" type="application/javascript"></script>
@endsection
