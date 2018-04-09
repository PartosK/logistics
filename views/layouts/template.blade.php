<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>МТК</title>

    <!-- Fonts -->
    <link href="{{ URL::asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('bootstrap/css/bootstrap-theme.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

    <script src="{{ URL::asset('js/jquery-2.1.3.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('js/jquery-ui.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('bootstrap/js/bootstrap.js')}}" type="application/javascript"></script>

    <!-- moment -->
    <script src="{{ URL::asset('moment/js/moment.js')}}" type="application/javascript"></script>
    <script src="{{ URL::asset('moment/js/moment-with-locales.js')}}" type="application/javascript"></script>

    <script src="{{ URL::asset('bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}" type="application/javascript"></script>
</head>

<body>

@section('navbar')
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">


        <ul class="nav nav-tabs">
            <li><a href="{{URL::asset('/')}}"><img alt="Фирмы"
                                                                        src="{{URL::asset('images/mtk.png')}}"></br>
                    Главная</a></li>
            <li><a data-toggle="tab" href="#panel1"><img alt="Фирмы"
                                                                        src="{{URL::asset('images/firm.png')}}"></br>
                    Фирмы</a></li>
            <li><a data-toggle="tab" href="#panel2"><img alt="Контрагенты"
                                                         src="{{URL::asset('images/partners.png')}}"></br>
                    Контрагенты</a></li>
            <li><a data-toggle="tab" href="#panel3"><img alt="Отправитель"
                                                         src="{{URL::asset('images/partners.png')}}"></br>
                    Отправитель</a></li>
            <li><a data-toggle="tab" href="#panel4"><img alt="Машины"
                                                         src="{{URL::asset('images/avto.png')}}"></br>
                    Специи</a></li>
            <li><a data-toggle="tab" href="#panel5"><img alt="Документы"
                                                         src="{{URL::asset('images/docs.png')}}"></br>
                    Документы</a></li>
            <li><a data-toggle="tab" href="#panel6"><img alt="Претензии"
                                                         src="{{URL::asset('images/docs.png')}}"></br>
                    Претензии</a></li>
            <li><a data-toggle="tab" href="#panel7"><img alt="Машины"
                                                         src="{{URL::asset('images/avto.png')}}"></br>
                    Общий прайс</a></li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Выход
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>





        <div class="tab-content">
            <div id="panel0" class="tab-pane fade in active">

            </div>
            <div id="panel1" class="tab-pane fade">
                <h3>Фирмы</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("firm-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("firms-list")}}">Список фирм</a>
                </div>
            </div>
            <div id="panel2" class="tab-pane fade">
                <h3>Контрагенты</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("contractor-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("contractors-list")}}">Список контрагентов</a>
                </div>
            </div>
            <div id="panel3" class="tab-pane fade">
                <h3>Отправители</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("sender-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("senders-list")}}">Список отправителей</a>

                </div>
            </div>
            <div id="panel4" class="tab-pane fade">
                <h3>Специи</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("spice-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("spices-list")}}">Список специй</a>
                </div>
            </div>
            <div id="panel5" class="tab-pane fade">
                <h3>Документы</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("doc-head-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("docs-list")}}">Список документов</a>
                </div>
            </div>
            <div id="panel6" class="tab-pane fade">
                <h3>Претензии</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("pretension-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("pretensions-list")}}">Список претензий</a>

                </div>
            </div>
            <div id="panel7" class="tab-pane fade">
                <h3>Общий прайс</h3>
                <div class="btn-group" role="group" aria-label="...">
                    <a class="btn btn-success" href="{{Route("route-price-all-add")}}">Добавить</a>
                    <a class="btn btn-default" href="{{Route("route-price-all")}}">Общий прайс</a>

                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</nav>
@endsection
@yield('navbar')

@yield('content')



</body>

</html>