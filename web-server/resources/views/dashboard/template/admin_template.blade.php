<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>داشبورد</title>
    <link href="{{ asset('stylesheets/jquery.mmenu.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('stylesheets/dataTables.semanticui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('stylesheets/buttons.datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('stylesheets/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('stylesheets/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/emoji/emoji.css')}}" rel="stylesheet">
    <style type="text/css">
        .croppie-container {
            width: 100%;
            height: 100%;
            margin: 20px auto;
            text-align: -webkit-center;
        }

        .croppie-container .cr-image {
            z-index: -1;
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: 0 0;
            max-height: none;
            max-width: none;
        }

        .croppie-container .cr-boundary {
            position: relative;
            overflow: hidden;
            z-index: 1;
            width: 100%;
            height: 100%;
            border: 1px solid;
        }

        .croppie-container .cr-viewport,
        .croppie-container .cr-resizer {
            position: absolute;
            border: 2px solid #fff;
            margin: auto;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            box-shadow: 0 0 2000px 2000px rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .croppie-container .cr-resizer {
            z-index: 2;
            box-shadow: none;
            pointer-events: none;
        }

        .croppie-container .cr-resizer-vertical,
        .croppie-container .cr-resizer-horisontal {
            position: absolute;
            pointer-events: all;
        }

        .croppie-container .cr-resizer-vertical::after,
        .croppie-container .cr-resizer-horisontal::after {
            display: block;
            position: absolute;
            box-sizing: border-box;
            border: 1px solid black;
            background: #fff;
            width: 10px;
            height: 10px;
            content: '';
        }

        .croppie-container .cr-resizer-vertical {
            bottom: -5px;
            cursor: row-resize;
            width: 100%;
            height: 10px;
        }

        .croppie-container .cr-resizer-vertical::after {
            left: 50%;
            margin-left: -5px;
        }

        .croppie-container .cr-resizer-horisontal {
            right: -5px;
            cursor: col-resize;
            width: 10px;
            height: 100%;
        }

        .croppie-container .cr-resizer-horisontal::after {
            top: 50%;
            margin-top: -5px;
        }

        .croppie-container .cr-original-image {
            display: none;
        }

        .croppie-container .cr-vp-circle {
            border-radius: 50%;
        }

        .croppie-container .cr-overlay {
            z-index: 1;
            position: absolute;
            cursor: move;
            touch-action: none;
        }

        .croppie-container .cr-slider-wrap {
            width: 75%;
        }

        .croppie-result {
            position: relative;
            overflow: hidden;
        }

        .croppie-result img {
            position: absolute;
        }

        .croppie-container .cr-image,
        .croppie-container .cr-overlay,
        .croppie-container .cr-viewport {
            -webkit-transform: translateZ(0);
            -moz-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }
    </style>
</head>

<body class="dashboard">
<div id="page">
    <div class="wrapper clearfix">
        <div class="row">
            <div class="col-xs-12">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <a class="bar-ico" href="#menu"><i class="map-bars"></i></a>
                        <a class="navbar-brand" href="#"><img src="{{asset('/images/logo.png')}}" href="100"></a>
                    </div>
                    <div class="collapse navbar-collapse hidden-md hidden-sm hidden-xs"
                         id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();"><i class="map-logout"></i>خروج</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col col-lg-4 col-xs-12">
                        @include('dashboard.template.sidebar')
                    </div>

                    <div class="col col-lg-8 col-xs-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--here--}}
</div>

<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.mmenu.js') }}"></script>
<script src="{{ asset('frameworks/bootstrap/javascripts/bootstrap.min.js') }}"></script>
<script src="{{ asset('frameworks/semantic/javascripts/semantic-ui/transition.js') }}"></script>
<script src="{{ asset('frameworks/semantic/javascripts/semantic-ui/dropdown.js') }}"></script>
<script src="{{ asset('frameworks/semantic/javascripts/semantic-ui/checkbox.js') }}"></script>
<script src="{{ asset('frameworks/semantic/javascripts/semantic-ui/form.js') }}"></script>
<script src="{{ asset('js/tables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/dataTables.semanticui.min.js') }}"></script>
<script src="{{ asset('js/tables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/tables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('js/tables/jszip.min.js') }}"></script>
<script src="{{ asset('js/tables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/tables/buttons.jqueryui.min.js') }}"></script>
<script src="{{ asset('js/tables/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/tables/buttons.semanticui.min.js') }}"></script>
<script src="{{ asset('js/tables/persian.js') }}"></script>
<script src="{{ asset('js/picker.js') }}"></script>

<script src="{{asset('js/emoji/config.js')}}"></script>
<script src="{{asset('js/emoji/util.js')}}"></script>
<script src="{{asset('js/emoji/jquery.emojiarea.js')}}"></script>
<script src="{{asset('js/emoji/emoji-picker.js')}}"></script>


<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();
        $('.ui.checkbox').checkbox();
        $('#sortable_tb').DataTable({
            bInfo: false,
            "bPaginate": false,
            "bFilter": false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="map-excel"></i>',
                    titleAttr: 'اکسل'
                },
                {
                    extend: 'print',
                    text: '<i class="map-printer"></i>',
                    titleAttr: 'پرینت'
                }
            ],
            columnDefs: [{
                "targets": ['delete_th', 'edit_th'],
                "orderable": false,
            }]
        });
    });
</script>
<script type="text/javascript" .>
    $('nav#menu').mmenu({
        extensions: ["effect-slide-menu", "shadow-page"],
        searchfield: true,
        counters: true,
        offCanvas: {
            position: "right"
        },
        navbar: {
            title: 'منو'
        },
        navbars: [
            {
                position: "top",
                content: ["searchfield"]
            }, {
                position: "top",
                content: [
                    "prev",
                    "title",
                    "close"
                ]
            }, {
                position: "bottom",
                content: [
                    '<a href="#">Cpay</a>'
                ]
            }
        ]
    });
</script>
<script>
    $.ajaxSetup({
        cache: false,
        headers:
            {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>
@yield('footer')
</body>
</html>