@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить документ
        <form class="form-horizontal" action="{{Route("doc-table-add")}}" method="POST">
            <div class="form-group">
                <label class="col-sm-2 control-label">Фирма</label>
                <div class="col-sm-10">
                    <select class="form-control" name="firm_id" id="firm_id">
                    @foreach($firms as $firm)
                        <option value="{{$firm->id}}" >{{$firm->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Дата</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="datereading" name="date" placeholder="Дата" value="{{ date('d-m-Y') }}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Номер документа</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="number" name="number" placeholder="Номер" value="{{$number}}" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Контрагент</label>
                <div class="col-sm-10">
                    <div class=" input-group">
                        <input type="text" class="form-control" id="find_contractor" placeholder="Поиск контрагента">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-search" ></span></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">Направление</label>
                <div class="col-sm-10">
                    <select class="form-control" name="route_contractors_id" id="route_contractors_id" disabled>
                        <option>Выберите контрагента</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label">Специя</label>
                <div class="col-sm-10">
                    <select class="form-control" name="spice_id" id="spice_id" >
                    @foreach($spices as $spice)
                        <option value="{{$spice->id}}" >{{$spice->prefix}}{{$spice->number}} {{$spice->date}}</option>
                    @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label  class="col-sm-2 control-label">Расчет</label>
                <div class="col-sm-10">
                    <select class="form-control" name="doctype_id" id="doctype_id" disabled>
                        <option>Выберите контрагента</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>


            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" id="contractor_id" name="contractor_id" value="" />
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




        $("#find_contractor").autocomplete({
            source:'contractor-find',
            select: function( event, ui){

                $('#contractor_id').val(ui.item.id);



                var options = '';
                if ( true == ui.item.payment_bank) {
                    options += '<option value="1">Безналичные</option>';
                }
                if ( true == ui.item.payment_cash) {
                    options += '<option value="2">Наличые</option>';
                }

                $('#doctype_id').html(options);
                $('#doctype_id').attr('disabled', false);

                getRouteContractor(ui.item.id);
            }
        });


        function getRouteContractor(id) {

            $.ajax({
                type: 'GET',
                url: "contractor-routes-select",
                dataType: 'text',
                data: {
                    "id": id

                },
                cache: false,
                success: function (returnValue) {

                    var Json_mas = $.parseJSON(returnValue);

                    var options ='';
                    for (var i=0; i<= Json_mas.length-1; i++){

                        var id = Json_mas[i].id;

                        options += '<option value="' + Json_mas[i].id + '">'+ Json_mas[i].id + ' ' + Json_mas[i].from + ' - ' + Json_mas[i].in + '</option>';

                    }
                    $('#route_contractors_id').html(options);
                    $('#route_contractors_id').attr('disabled', false);

                }
            });
        }

        });
    </script>

    @endsection
