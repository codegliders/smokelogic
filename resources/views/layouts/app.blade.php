<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]-->
    <!--html lang="en"-->
    <head>
        <title><?php echo 'MetaMatic SmokeLogic '; //trans('messages.webapp_title');   ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS-->
        <!--link href="{{asset('assets/css/normalize.css')}}" rel="stylesheet" type="text/css'"/>
         <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css'"/-->



        <link href="{{asset('assets/lib/kendo/css/kendo.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('assets/lib/kendo/css/kendo.common.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/lib/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/lib/bootstrap/css/bootstrap.css')}}">
        <!--link href="{{asset('assets/lib/fuelux/css/fuelux.min.css')}}" rel="stylesheet" type="text/css"/-->
        <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap/css/bootstrap-theme.min.css')}}">
        <!--link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/slate/bootstrap.min.css" rel="stylesheet" integrity="sha256-Ucf/ylcKTNevYP6l7VNUhGLDRZPQs1+LsbbxuzMxUJM= sha512-FW2XqnqMwERwg0LplG7D64h8zA1BsxvxrDseWpHLq8Dg8kOBmLs19XNa9oAajN/ToJRRklfDJ398sOU+7LcjZA==" crossorigin="anonymous"-->

        <!--   JavaScript -->
        <script src="{{ asset('assets/lib/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
        <!--[if lt IE 7]>
 <p class="chromeframe">Stai utilizzando una versione del browser obsoleta
 <strong>obsoleta</strong> Aggiorna il browser a una versione più recente. ...
 <![endif]-->
        <script src="{{ asset('assets/lib/jquery.min.js')}}"></script>
        <script src="{{ asset('assets/lib/moment.min.js')}}"></script>


        <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.min.js')}}"></script>
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css'"/>
        <!--kendo-->
        <script src="{{ asset('assets/lib/kendo/js/kendo.core.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.data.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.userevents.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.color.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.drawing.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.dataviz.core.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.dataviz.themes.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.dataviz.chart.min.js')}}"></script>
        <script src="{{ asset('assets/lib/kendo/js/kendo.pdf.min.js')}}"></script>


    </head>

    <body>
        <div class="container">
            <div class="page-header">
                <div class="row" style="position:relative">
                    <div class="col col-md-9 col-sm-9 col-xs-12" style="color:#fff;">
                        <h3 > <span class="fa fa-cloud fa-lg" ></span>
                            <?php echo 'SmokeLogic'; //trans('messages.glucologic'); ?>
                        </h3>

                        <?php echo 'Take control of cigarettes you smoke'; //trans('messages.motto'); ?>
                    </div>
                    <div class="col col-md-3 col-sm-12 col-xs-12" style="bottom:0;
                         right:0;color:#fff;">
                        <?php
                        if (Auth::check() == true) {
                            $userstring = "";
                            $userstring = '&nbsp; <div class="fa fa-user fa-lg" ></div> &nbsp;<strong> Hi, '
                                    . Auth::user()->name . "</strong>";
                            $space = "&nbsp;&nbsp;&nbsp;&nbsp;";

                            echo $userstring;
                            echo $space;
                            $logoutstring = '<a href="auth/logout" style="color:#fff;text-decoration:none">Logout&nbsp<i class="fa fa-btn fa-sign-out fa-lg"></i></a>';
                            echo $logoutstring;
                        }
                        ?></a>&nbsp;&nbsp;&nbsp;
                                         <!--a href="auth/logout" style="color:#fff">&nbsp;<?php //trans('messages.logout');   ?>&nbsp<i class="fa fa-btn fa-sign-out fa-lg"></i></a-->
                    </div>
                </div>
            </div>

            <!-- Static navbar -->
            <!--nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div id="navbar" class="navbar-collapse collapse" role="navigation">

                        <ul class="nav navbar-nav">
            <?php if (Auth::check() == true) { ?>
                                  


            <?php } ?>
                        </ul>



                        <ul class="nav navbar-nav navbar-right">
                            <li> <div id="insertTestButtonDiv" >
                                    <form class="navbar-form navbar-left" action="/cig">

                                    </form>
                                </div></li>
            <?php if (Auth::check() !== false) { ?>

                                    <li>
                                        <a >
                <?php
                if (Auth::check() == true) {
                    $userstring = "";
                    $userstring = '&nbsp; <span class="fa fa-user fa-lg" ></span> &nbsp;<strong> '
                            . Auth::user()->name . "</strong>";
                    echo $userstring;
                }
                ?></a>
                                    </li>

                                    <li><a href="auth/logout"><i class="fa fa-btn fa-sign-out fa-lg"></i>&nbsp;<?php echo 'Logout'; //trans('messages.logout');   ?></a></li>
<?php } else { ?>
                                    <li><a href="auth/register" ><?php echo 'Register' //trans('messages.register');   ?></a></li>
                                    <li><a href="auth/login" ><?php echo 'Login'; //trans('messages.login');  ?></a></li>
<?php } ?>

                        </ul>
                    </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav-->
</div>

@yield('content')
</body>
</html>