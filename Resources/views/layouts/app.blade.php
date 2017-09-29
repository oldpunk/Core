<?
$args = [];
$args['new_feedback'] = '';
$args['new_feedback']['cnt'] = 0;
$kernel = [];
$kernel['username'] = '';
$kernel['id_user'] = 0;
$args['config'] = [];
$args['config']['modules_name'] = [];
$args['subtitle'] =1;
$args['mod_parents'] = [];
$args['mod'] = '1';

?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hamitsu') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/css/all.css') }}" rel="stylesheet" type="text/css"/>

    @stack('css')

    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="/admin/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="/admin/">
                <img src="/admin/img/c-tm-logo.svg" alt="logo" class="logo-default"/>
            </a>
            <div class="sidebar-toggler si-icon si-icon-hamburger" data-icon-name="hamburger"></div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <!--		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                </a>-->
        <div class="responsive-toggler si-icon si-icon-hamburger-resp" data-icon-name="hamburger" data-toggle="collapse" data-target=".navbar-collapse"></div>

        <!-- END RESPONSIVE MENU TOGGLER -->

        <div class="page-actions">
            <div class="btn-group">
                <a class="btn btn-sm blue" href="http://<?=$_SERVER['HTTP_HOST']?>/" target="_blank"><i class="fa fa-eye"></i> Перейти на сайт</a>
            </div>

        </div>

        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">

            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide">
                    </li>
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
                        <a href="/admin/?mod=feedback" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <?if($args['new_feedback']['cnt']){?>
                            <span class="badge badge-danger"><?=$args['new_feedback']['cnt']?> </span>
                            <?}?>
                        </a>
                        <?if($args['new_feedback']['cnt']){?>
                        <ul class="dropdown-menu">
                            <li class="external">

                                <h3><span class="bold"><?=$args['new_feedback']['cnt']?> <?='Новых'?></span> <?='сообщений'?></h3>
                                <a href="/admin/?mod=feedback"><?='Смотреть все'?></a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list"  data-handle-color="#637283">
                                    <?foreach($args['new_feedback']['rows'] as $v){?>
                                    <li>
                                        <a href="/admin/?mod=feedback&act=edititem&id=<?=$v['id']?>">
                                                                                <span class="photo">
										<img src="/admin/img/avatar.png" class="img-circle" alt="" />
										</span>
                                            <span class="subject">
                                                                                    <span class="from"><?=$v['fio']?></span>
                                                                                    <span class="time"><?=date('d.m.Y', $v['date'])?></span>
										</span>
                                            <span class="message"><?=$v['title']?> </span>
                                        </a>
                                    </li>
                                    <?}?>
                                </ul>
                            </li>
                        </ul>
                        <?}?>
                    </li>
                    <!-- END INBOX DROPDOWN -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						{{ Auth::user()->name }} </span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            @if(Auth::user()->logo)
                                <img alt="" class="img-circle" src="{{ Auth::user()->logo }}"/>
                            @else
                                <img alt="" class="img-circle" src="/admin/img/avatar9.jpg"/>
                            @endif

                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('users.show', Auth::user()->id) }}">
                                    <i class="icon-user"></i> <?='Профиль'?> </a>
                            </li>

                            <li class="divider">
                            </li>
                            <li>
                                <a href="/admin/lock.php">
                                    <i class="icon-lock"></i> <?=_('Закрыть экран')?> </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> <?=_('Выйти')?> </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-extended ">
                        <a class="icon-logout tosite" href="/admin/logout.php" title="<?=_('Выйти')?>"></a>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->

    @include('core::partials.left-menu')

    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>@yield('page-title')</h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="/admin/">CMS</a>
                </li>


                <li class="active">
                    <i class="fa fa-circle"></i>@yield('page-title')
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row">
                <div class="col-md-12">

                <?if($args['mod']){?>
                <!-- module -->


                    @yield('content')


                <!--/module -->
                    <?}elseif($errors['notfound']){?>
                <!-- nofound -->
                    <div class="Metronic-alerts alert alert-danger fade in">
                        Модуль не установлен!
                    </div>
                    <!--/nofound -->
                    <?}elseif($errors['action']){?>
                <!-- nofound -->
                    <div class="Metronic-alerts alert alert-danger fade in">
                        Действие не найдено!
                    </div>
                    <!--/nofound -->
                    <?}elseif($errors['perm']){?>
                <!-- perm -->
                    <div class="Metronic-alerts alert alert-danger fade in">
                        Доступ запрещен!
                    </div>
                    <!--/perm -->
                    <?}else{?>
                <!-- splash -->
                    <table width="100%" cellpadding="4" cellspacing="2" class="table">
                        <tr><th colspan="2" style="font-size:1.25em; font-weight:bold; text-align:left;">Модули</th></tr>
                        <?foreach($args['modules'] as $i)if($i['section']=='modules'){?>
                        <tr>
                            <td><a href="/admin/?mod=<?=htmlspecialchars($i['name'])?>" style="margin-left:20px"><?=htmlspecialchars($i['title'])?></a></td>
                            <td>&nbsp;<?=htmlspecialchars($i['descr'])?></td>
                        </tr>
                    <?}?>
                    <?}?>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->

        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        2015 &copy; <a href="http://c-tm.ru/" title="Creative team" target="_blank">Creative team</a>.
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->

<script src="/admin/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{ asset('admin/js/all.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@stack('scripts')

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        ComponentsPickers.init();
    });
</script>


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>