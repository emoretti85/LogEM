<?php
define("LOG_PATH","..\log");
require_once 'phpClass/Finfo.php';
$Files=EMFinfo::getFinfos(LOG_PATH);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>EMLog - Dashboard</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
body {
	padding-top: 50px;
	padding-bottom: 20px;
}
</style>
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
<body>
	<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">EMLog - Dashboard</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">


				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php"><span class="glyphicon glyphicon-refresh">
								Refresh LogList</span> </a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">Select Log file <span class="caret"></span>
					</a>
						<ul class="dropdown-menu" role="menu">
							<?php 
							foreach ($Files as $key => $value) {
                                  echo '<li><a href="index.php?id='.$key.'"> <span class="glyphicon glyphicon-list-alt"> '.$value['Name'].'</span></a></li>
                                <li class="divider"></li>';
                
                              }
                              ?>
						</ul>
					</li>
					<li>
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group"></div>

						</form>
					</li>
				</ul>

			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<?php if(!isset($_GET['id'])){?>
			<h1>Select one file Log!</h1>
			<p>Select one of the log file from the list in the menu at the top
				right , in order to analyze various aspects of the log .</p>
			<?php }elseif(isset($_GET['id']) && isset($Files[$_GET['id']]) && is_array($Files[$_GET['id']])){?>
			<h1>
				<?php echo $Files[$_GET['id']]['Name'];?>
			</h1>
			<p>
				<?php foreach ($Files[$_GET['id']] as $key=> $value) {
				    echo $key ." : ".$value."<br/>";
				        }
				?>
			</p>
			<?php }else echo "<h1>Opss! Houston, we have a problem...</h1>"?>
		</div>
	</div>

	<?php if (isset($_GET['id']) && isset($Files[$_GET['id']]) && is_array($Files[$_GET['id']])){?>
	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-sm-10">
				<h2>
					Content <a class="btn btn-default"
						href="index.php?id=<?php echo $_GET['id']; ?>" role="button"><span
						class="glyphicon glyphicon-refresh"> Refresh</span> </a>
				</h2>
				<input type="text" class="form-control" placeholder="Search"
					id="text-search" /><br /> <br />

				<?php 
    				$FileContent=file_get_contents($Files[$_GET['id']]['Path']);
    				$Arr=explode("\n",$FileContent);
    
    				foreach ($Arr as $key => $value) {
                            $a=json_decode($value,true);
                            unset($a[0]);
                            if(is_array($a)){
                                echo "<p>".$a['date_d']." ".$a['date_h']." - " .$a['type']." : ". $a['msg'];
                            }
                       }
                       ?>
				<p>
					<a class="btn btn-default" href="#" role="button"><span
						class="glyphicon glyphicon-refresh"> Refresh</span> </a>
				</p>
			</div>
		</div>
		<?php }?>
		<hr>

		<footer>
			<p>&copy; EMLog 2014 ::::: Bootstrap v3.1.1 <a href="http://getbootstrap.com">getbootstrap.com</a> ::::: Modernizr 2.6.2 (Custom Build) ::::: Highlights Jquery scripts by <a href="mailto:jb@eaio.com" target="_top">Johann Burkard</a> </p>
		</footer>
	</div>
	<!-- /container -->
	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>

	<script src="js/vendor/bootstrap.min.js"></script>

	<script src="js/main.js"></script>

	<script type="text/javascript" src="js/vendor/highlight.js"></script>
	<script type="text/javascript">
        $(function() {
            $('#text-search').bind('keyup change', function(ev) {
                // pull in the new value
                var searchTerm = $(this).val();
        
                // remove any old highlighted terms
                $('.container').removeHighlight();
        
                // disable highlighting if empty
                if ( searchTerm ) {
                    // highlight the new term
                    $('.container').highlight( searchTerm );
                }
            });
        });
        </script>
</body>
</html>
