@extends('layouts.template')

@section('content')
    <div class="col-md-9">

        <div class="col-md-9">
            <div>
                <b>{{$doc->firm->name}}</b>
            </div>
            <div>
                <b>{{$doc->firm->address}}</b>
            </div>
            <div>
                <b> Телефоны: {{$doc->firm->phone}}</b>
            </div>
        </div>

        <table class="table table-bordered">
            <caption style="text-align: center"><b>Образец заполнения платежного поручения</b></caption>
            <tbody>
            <tr>
                <td>ИНН {{$doc->firm->inn}}</td>
                <td>КПП {{$doc->firm->kpp}}</td>
                <td rowspan="2">Счет №</td>
                <td rowspan="2">{{$doc->firm->account}}</td>
            </tr>
            <tr>
                <td colspan="2">{{$doc->firm->name}} <br>Получатель</td>
            </tr>
            <tr>
                <td rowspan="2" colspan="2">{{$doc->firm->namebank}}<br>Банк получателя</td>
                <td>БИК</td>
                <td>{{$doc->firm->bikbank}}</td>
            </tr>
            <tr>
                <td>Счет</td>
                <td>{{$doc->firm->accountbank}}</td>
            </tr>
            </tbody>
        </table>

        <table class="table table-bordered" style="margin-bottom: 1px;">
            <tr style="text-align: center">
                <td style="border-style:hidden solid hidden hidden"><b>СЧЕТ-договор</b></td>
                <td>Номер</td>
                <td><b>{{$doc->number}}</b></td>
                <td><b>{{  date( 'd-m-Y', strtotime($doc->date))}}</b></td>
                <td>Дата</td>
            </tr>
        </table>
        <table class="table" style="margin-bottom: 1px;">
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5" style="font-size: 9pt;">{{$doc->firm->name}}, именуемое в дальнейшем "Исполнитель", и {{$doc->contractor->name}}<br>
                    Именуемое в дальнейшем "Заказчик", заключили настоящий договор о нижеследующем:<br>
                    1. Исполнитель обязуется доставить предъявленный ему Заказчиком или отправителем, действующим по
                    указанию<br> Заказчика, груз в пункт выдачи по месту назначения и выдать их уполномоченному на
                    получения груза лицу, а <br>
                    Заказчик обязуется выплатить за оказанные услуги цену, определенную счетом-договором.<br>
                    2.Настояий счет-договор вступает в силу с момента получения груза.<br>
                    3.Оплата счета является согласием с суммой договора.
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5">Плательщик: {{$doc->contractor->name}} ИНН {{$doc->contractor->inn}}</td>
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="5">Примечание: СПЕЦИФИКАЦИЯ {{$doc->spice->number}} {{$doc->spice->prefix}}</td>
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
            <tr>
                <td colspan="5" style="text-align: right">в том числе НДС (18%):</td>
                <td colspan="2"></td>
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
                <td colspan="3">Директор
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    _____________________________
                    {{$doc->firm->director}}
                </td>
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="3">Главный бухгалтер
                    _____________________________
                    {{$doc->firm->buh}}
                </td>
            </tr>
            <tr style="border-style:hidden hidden hidden hidden">
                <td colspan="3" style="text-decoration: underline; font-weight: bold;">ПРОСИМ УКАЗЫВАТЬ НОМЕР
                    СЧЕТА-договора В НАЗНАЧЕНИИ ПЛАТЕЖА!
                </td>
            </tr>
        </table>

    </div>

@endsection
