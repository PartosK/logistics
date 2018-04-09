@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить автомобиль
        <form class="form-horizontal"  action="{{Route("pretension-add")}}" method="POST">


            <div class="form-group">
                <label  class="col-sm-2 control-label">Дата</label>
                <div class="col-sm-10">
                    <input class="form-control" id="datereading" name="date" placeholder="Дата">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Текст</label>
                <div class="col-sm-10">
                    <input class="form-control" id="text" name="text" placeholder="Текст">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Сумма претензии</label>
                <div class="col-sm-10">
                    <input class="form-control" id="price" name="price" placeholder="Сумма претензии">
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
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="hidden" id="contractor_id" name="contractor_id" value="" />
        </form>
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

                }
            });

        });

    </script>
    @endsection
