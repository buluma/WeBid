<!DOCTYPE html>
<html lang="en">
<head>
	<title>WeBid Administration back-end</title>
	<meta http-equiv="Content-Type" content="text/html; charset={CHARSET}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="WeBid">

	<link rel="stylesheet" media="screen,projection" type="text/css" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{SITEURL}themes/{THEME}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{SITEURL}includes/calendar.css">
	<link rel="stylesheet" type="text/css" href="{SITEURL}themes/{THEME}/css/sb-admin.css">
	<link rel="stylesheet" type="text/css" href="{SITEURL}themes/{THEME}/css/style.css">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{SITEURL}themes/{THEME}/js/jquery.js"></script>
	<script src="{SITEURL}themes/{THEME}/js/jquery-ui.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="{SITEURL}themes/{THEME}/js/bootstrap.min.js"></script>
	
	<!-- Custom Fonts -->
    <link href="{SITEURL}themes/{THEME}/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
		$(document).ready(function() {
			$('a.new-window').click(function(){
				window.open(this.href, this.alt, "toolbar=0,location=0,directories=0,scrollbars=1,screenX=100,screenY=100,status=0,menubar=0,resizable=0,width=550,height=550");
				return false;
			});
			$(".selectall").click(function() {
				var checked_status = this.checked;
				var checkbox_name = this.value;
				$("input[name=\"" + checkbox_name + "[]\"]").each(function() {
					this.checked = checked_status;
				});
			});
		});
	</script>
	<script type="text/javascript">
		function window_open(url,title,width,height,x,y)
		{
			var window_= 'toolbar=0,location=0,directories=0,scrollbars=1,screenX='+x+',screenY='+y+',status=0,menubar=0,resizable=0,width='+width+',height='+height;
			open(url,title,window_);
		}
	</script>
</head>
<body id="{CURRENT_PAGE}">
	<div id="wrapper">
	    <!-- Navigation -->
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="{SITEURL}themes/{THEME}/img/adminlogo.png"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {ADMIN_USER} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="editadminuser.php?id={ADMIN_ID}"><i class="fa fa-fw fa-user"></i> {L_5142}</a>
						</li>
						<li>
                            <a href="{SITEURL}" target="_blank"><i class="fa fa-fw fa-gear"></i> {L_5001}</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> {L_245}</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php" alt="{L_166}"><i class="fa fa-fw fa-dashboard"></i> {L_166}</a>
                    </li>
                    <li>
                        <a href="settings.php" alt="{L_5142}"><i class="fa fa-fw fa-cogs"></i> {L_5142}</a>
                    </li>
                    <li>
                        <a href="fees.php" alt="{L_25_0012}"><i class="fa fa-fw fa-money"></i> {L_25_0012}</a>
                    </li>
                    <li>
                        <a href="theme.php" alt="{L_25_0009}"><i class="fa fa-fw fa-edit"></i> {L_25_0009}</a>
                    </li>
                    <li>
                        <a href="managebanners.php" alt="{L_25_0011}"><i class="fa fa-fw fa-desktop"></i> {L_25_0011}</a>
                    </li>
                    <li>
                        <a href="listusers.php" alt="{L_25_0010}"><i class="fa fa-fw fa-users"></i> {L_25_0010}</a>
                    </li>
					 <li>
                        <a href="listauctions.php" alt="{L_239}"><i class="fa fa-fw fa-gavel"></i> {L_239}</a>
                    </li>
					 <li>
                        <a href="news.php" alt="{L_25_0018}"><i class="fa fa-fw fa-edit"></i> {L_25_0018}</a>
                    </li>
					 <li>
                        <a href="viewaccessstats.php" alt="{L_25_0023}"><i class="fa fa-fw fa-bar-chart-o"></i> {L_25_0023}</a>
                    </li>
					 <li>
                        <a href="errorlog.php" alt="{L_5436}"><i class="fa fa-fw fa-wrench"></i> {L_5436}</a>
                    </li>
					 <li>
                        <a href="help.php" alt="{L_148}"><i class="fa fa-fw fa-info-circle"></i> {L_148}</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


	    
	   <!-- 
	    <div class="row">
			<div class="col-md-6"><small>{L_559}: {LAST_LOGIN}</small></div>
			<div class="col-md-6 text-muted text-right">
<!-- BEGIN langs -->
	<!-- IF ! langs.B_DEFAULT -->
				<a href="index.php?lan={langs.LANG}"><img src="{SITEURL}images/flags/{langs.LANG}.gif"></a>
	<!-- ENDIF -->
<!-- END langs --> -->
			
	    <div id="page-wrapper">

            <div class="container-fluid">
		
    <!-- BEGIN alerts -->
		<div id="alerts">
			<div class="alert alert-{alerts.TYPE}">{alerts.MESSAGE}</div>
		</div>
	<!-- END alerts -->