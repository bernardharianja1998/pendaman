<?php
$server = require __DIR__ . '/core/config.php';
require_once __DIR__ . '/php_function/function.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr" class=" ">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mono - Responsive Admin &amp; Dashboard Template</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="mono/source/plugins/material/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="mono/source/plugins/simplebar/simplebar.css" rel="stylesheet">

    <!-- PLUGINS CSS STYLE -->
    <link href="mono/source/plugins/nprogress/nprogress.css" rel="stylesheet">
    <link href="mono/source/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="mono/source/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet">
    <link href="mono/source/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="mono/source/plugins/toaster/toastr.min.css" rel="stylesheet">

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="mono/theme/css/style.css">

    <!-- FAVICON -->
    <link href="mono/source/images/favicon.png" rel="shortcut icon">

    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script src="mono/source/plugins/nprogress/nprogress.js"></script>
    <style type="text/css">
        .apexcharts-canvas {
            position: relative;
            user-select: none;
            /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
        }

        /* scrollbar is not visible by default for legend, hence forcing the visibility */
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px;
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }

        .apexcharts-inner {
            position: relative;
        }

        .legend-mouseover-inactive {
            transition: 0.15s ease all;
            opacity: 0.20;
        }

        .apexcharts-series-collapsed {
            opacity: 0;
        }

        .apexcharts-gridline,
        .apexcharts-text {
            pointer-events: none;
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, 0.96);
        }

        .apexcharts-tooltip.dark {
            color: #fff;
            background: rgba(30, 30, 30, 0.8);
        }

        .apexcharts-tooltip * {
            font-family: inherit;
        }

        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-line {
            pointer-events: none;
        }

        .apexcharts-tooltip.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .apexcharts-tooltip.light .apexcharts-tooltip-title {
            background: #ECEFF1;
            border-bottom: 1px solid #ddd;
        }

        .apexcharts-tooltip.dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid #222;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            font-weight: 600;
            margin-left: 5px;
        }

        .apexcharts-tooltip-text-z-label:empty,
        .apexcharts-tooltip-text-z-value:empty {
            display: none;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            font-weight: 600;
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center;
        }

        .apexcharts-tooltip-series-group.active .apexcharts-tooltip-marker {
            opacity: 1;
        }

        .apexcharts-tooltip-series-group.active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px;
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-candlestick {
            padding: 4px 8px;
        }

        .apexcharts-tooltip-candlestick>div {
            margin: 4px 0;
        }

        .apexcharts-tooltip-candlestick span.value {
            font-weight: bold;
        }

        .apexcharts-xaxistooltip {
            opacity: 0;
            padding: 9px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
            transition: 0.15s ease all;
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-xaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-left: -6px;
        }

        .apexcharts-xaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-left: -7px;
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%;
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%;
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90A4AE;
        }

        .apexcharts-xaxistooltip.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-yaxistooltip {
            opacity: 0;
            padding: 4px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-yaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-top: -6px;
        }

        .apexcharts-yaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-top: -7px;
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%;
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%;
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90A4AE;
        }

        .apexcharts-yaxistooltip.active {
            opacity: 1;
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: 0.15s ease all;
        }

        .apexcharts-xcrosshairs.active,
        .apexcharts-ycrosshairs.active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0;
        }

        .apexcharts-zoom-rect {
            pointer-events: none;
        }

        .apexcharts-selection-rect {
            cursor: move;
        }

        .svg_select_points,
        .svg_select_points_rot {
            opacity: 0;
            visibility: hidden;
        }

        .svg_select_points_l,
        .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible;
            fill: #888;
        }

        .apexcharts-canvas.zoomable .hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-canvas.zoomable .hovering-pan {
            cursor: move
        }

        .apexcharts-xaxis,
        .apexcharts-yaxis {
            pointer-events: none;
        }

        .apexcharts-zoom-icon,
        .apexcharts-zoom-in-icon,
        .apexcharts-zoom-out-icon,
        .apexcharts-reset-zoom-icon,
        .apexcharts-pan-icon,
        .apexcharts-selection-icon,
        .apexcharts-menu-icon,
        .apexcharts-toolbar-custom-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6E8192;
            text-align: center;
        }

        .apexcharts-zoom-icon svg,
        .apexcharts-zoom-in-icon svg,
        .apexcharts-zoom-out-icon svg,
        .apexcharts-reset-zoom-icon svg,
        .apexcharts-menu-icon svg {
            fill: #6E8192;
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(0.76)
        }

        .apexcharts-zoom-icon.selected svg,
        .apexcharts-selection-icon.selected svg,
        .apexcharts-reset-zoom-icon.selected svg {
            fill: #008FFB;
        }

        .apexcharts-selection-icon:not(.selected):hover svg,
        .apexcharts-zoom-icon:not(.selected):hover svg,
        .apexcharts-zoom-in-icon:hover svg,
        .apexcharts-zoom-out-icon:hover svg,
        .apexcharts-reset-zoom-icon:hover svg,
        .apexcharts-menu-icon:hover svg {
            fill: #333;
        }

        .apexcharts-selection-icon,
        .apexcharts-menu-icon {
            position: relative;
        }

        .apexcharts-reset-zoom-icon {
            margin-left: 5px;
        }

        .apexcharts-zoom-icon,
        .apexcharts-reset-zoom-icon,
        .apexcharts-menu-icon {
            transform: scale(0.85);
        }

        .apexcharts-zoom-in-icon,
        .apexcharts-zoom-out-icon {
            transform: scale(0.7)
        }

        .apexcharts-zoom-out-icon {
            margin-right: 3px;
        }

        .apexcharts-pan-icon {
            transform: scale(0.62);
            position: relative;
            left: 1px;
            top: 0px;
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6E8192;
            stroke-width: 2;
        }

        .apexcharts-pan-icon.selected svg {
            stroke: #008FFB;
        }

        .apexcharts-pan-icon:not(.selected):hover svg {
            stroke: #333;
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            top: 0px;
            right: 3px;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0px 6px 2px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apexcharts-toolbar svg {
            pointer-events: none;
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: 0.15s ease all;
            pointer-events: none;
        }

        .apexcharts-menu.open {
            opacity: 1;
            pointer-events: all;
            transition: 0.15s ease all;
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .apexcharts-menu-item:hover {
            background: #eee;
        }

        @media screen and (min-width: 768px) {
            .apexcharts-toolbar {
                /*opacity: 0;*/
            }

            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1;
            }
        }

        .apexcharts-datalabel.hidden {
            opacity: 0;
        }

        .apexcharts-pie-label,
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value {
            cursor: default;
            pointer-events: none;
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: 0.3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease;
        }

        .apexcharts-canvas .hidden {
            opacity: 0;
        }

        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }

        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon {
            pointer-events: none;
        }

        /* markers */

        .apexcharts-marker {
            transition: 0.15s ease all;
        }

        @keyframes opaque {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>


<body class="" id="body" style="background-color:#1d1f26;">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>



    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">


        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->




        <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-primary" id="navbar">
                    <!-- Sidebar toggle button -->

                    <!-- <div class="app-brand">
                        <a href="#">
                            <img src="mono/theme/images/logo.png" style="max-width: 75px;">
                            <span class="page-title">RS Bhayangkara</span>
                        </a>
                    </div> -->
                    <a href="#" class="pl-3">
                        <img src="mono/theme/images/logo.png" style="max-width: 70px;">
                    </a>
                    <span class="page-title pl-1">RS Bhayangkara H.S Samsoeri Surabaya</span>
                    <div class="navbar-right ">
                        <span class="page-title pl-1"><?= day_in_indo(); ?>, <?= date_in_indo(); ?> <span id="time"></span></span>
                    </div>
                </nav>
            </header>

            <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
            <div class="content-wrapper">
                <div class="content">
                    <div class="row inputCode">
                        <div class="col-lg-12">
                            <form id="form">
                                <div class="form-group display">
                                    <input class="form-control form-control-lg" type="text" name="displayResult" id="displayResult" style="font-size : 50px; width: 100%; height: 105px;" placeholder="MASUKKAN KODE BOOKING ANDA">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row inputCode">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="1" onclick="inputNumber(this.value)">1</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="2" onclick="inputNumber(this.value)">2</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="3" onclick="inputNumber(this.value)">3</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="4" onclick="inputNumber(this.value)">4</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="5" onclick="inputNumber(this.value)">5</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="6" onclick="inputNumber(this.value)">6</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="7" onclick="inputNumber(this.value)">7</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="8" onclick="inputNumber(this.value)">8</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="9" onclick="inputNumber(this.value)">9</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-danger" style="font-size : 50px; width: 100%; height: 105px;" onclick="deleteNumber()"><i class="mdi mdi-backspace"></i></button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-primary" style="font-size : 50px; width: 100%; height: 105px;" value="0" onclick="inputNumber(this.value)">0</button>
                                </div>
                                <div class="col-lg-4 mb-1">
                                    <button type="button" class="mb-1 btn btn-block btn-success" style="font-size : 50px; width: 100%; height: 105px;" onclick="proceed()"><i class="mdi mdi-check"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="copyright bg-dark">
                    <p>
                        © <span id="copy-year">2022</span> Copyright Mono Dashboard Bootstrap Template by <a class="text-primary" href="http://www.iamabdus.com/" target="_blank">Abdus</a>.
                    </p>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>

    <script src="mono/source/plugins/jquery/jquery.min.js"></script>
    <script src="mono/source/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="mono/source/plugins/simplebar/simplebar.min.js"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="mono/source/plugins/apexcharts/apexcharts.js"></script>
    <script src="mono/source/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="mono/source/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="mono/source/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
    <script src="mono/source/plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
    <script src="mono/source/plugins/daterangepicker/moment.min.js"></script>
    <script src="mono/source/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="mono/source/plugins/toaster/toastr.min.js"></script>

    <script src="mono/source/js/mono.js"></script>
    <script src="mono/source/js/chart.js"></script>
    <script src="mono/source/js/map.js"></script>
    <script src="mono/source/js/custom.js"></script>

    <!--  -->
    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>

    <script type="text/javascript">
        var server = "<?= $server["URL"] ?>";
    </script>
    <script type="text/javascript" src="js/app.js"></script>
</body>

</html>