@extends('layouts.template')



@section('content2')
    <div class="col-md-9">
        <br>
        <table class="table table-bordered" style="margin-bottom: 1px;">
            <tr style="text-align: center">
                <td>Расчет стоимости перевозки СП {{$doc->spice->number}} {{$doc->spice->prefix}}</td>
                <td><b>{{  date( 'd-m-Y', strtotime($doc->date))}}</b></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-bordered" style="margin-bottom: 1px;">
            <tr style="text-align: center">
                <td style="border-style:hidden solid hidden hidden"><b>РАСЧЕТ-нал</b></td>
                <td>Номер</td>
                <td><b>{{$doc->number}}</b></td>
                <td><b>Выдача - {{  $doc->date_issue}}</b></td>
                <td>Дата</td>
            </tr>
        </table>
        <table class="table" style="margin-bottom: 1px;">
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5" style="font-size: 9pt;">
                    1. Исполнитель обязуется доставить предъявленный ему Заказчиком или отправителем, действующим по
                    указанию<br> Заказчика, груз в пункт выдачи по месту назначения и выдать их уполномоченному на
                    получения груза лицу,а <br>
                    Заказчик обязуется оплатить оказанные услуги.
            </tr>
        </table>
        <table class="table table-bordered" style="margin-bottom: 1px;">

            <thead>
            <tr>
                <th>№</th>
                <th>Предмет счета (наименование услуги)</th>
                <th>Транс-<br>портный документ</th>
                <th>Еденица измерения</th>
                <th>Кол.</th>
                <th>Цена, Руб., коп.</th>
                <th>Сумма, рублей</th>
            </tr>
            </thead>
            <tbody>
            @foreach($doc_tr as $tr)
            <tr>
                <td>{{$tr->trnumber}}</td>
                <td>{{$tr->service}} {{$tr->route_contractor}} {{$tr->sender}}</td>
                <td>{{$tr->different}}</td>
                <td>{{$tr->unit->name}}</td>
                <td>{{$tr->count}}</td>
                <td>{{$tr->price}}</td>
                <td>{{$tr->total_price_tr}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right">ВЕГО К ОПЛАТЕ:</td>
                <td colspan="2">{{$doc->total_price}}</td>
            </tr>
            </tbody>
        </table>
        <table class="table" style="margin-bottom: 1px;">
            <tr>
                <td colspan="3" style="border-style:hidden hidden hidden hidden">
                    Всего наименований {{count($doc_tr)}}, на сумму {{$total_price_rub[0]}} РУБ.  {{$total_price_rub[1]}} КОП.<br>
                    <b>{{mb_ucfirst(num2str($doc->total_price))}}</b>
                </td>
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="3" style=" font-weight: bold;">ПОДПИСЬ ПЛАТЕЛЬЩИКА_____________________________
                </td>
            </tr>
        </table>

    </div>

@endsection

@section('content')
    @yield('content2')

    @yield('content2')
@endsection