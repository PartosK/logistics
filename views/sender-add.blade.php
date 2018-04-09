@extends('layouts.template')

@section('content')
    <div class="col-md-9">
        Добавить фирму
        <form class="form-horizontal" action="{{Route("sender-add")}}" method="POST">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Наименование</label>
                <div class="col-sm-10">
                    <input  class="form-control" id="name" name="name" placeholder="Наименование">
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

            $("#find_contractor").autocomplete({
                source:'contractor-find',
                select: function( event, ui){

                    $('#contractor_id').val(ui.item.id);

                }
            });

        });

    </script>
    @endsection
