
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test task</title>

     <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/blog-post.css" rel="stylesheet">

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <form class="form-inline" id="searchForm" action="<?=App::helper()->makeUrl('map','search');?>">>
                  <div class="form-group">
                    <input type="text" class="form-control" id="icaoCode" name="icao" placeholder="ICAO">
                  </div>
                  <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- Page Content -->
    <div class="container">
    	<?php
    		echo $content; 
    	?>
        <hr>
    </div>
    <!-- /.container -->

    <script src="/js/scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?=GMAP_KEY?>&callback=initMap"
         async defer></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

</body>

</html>
