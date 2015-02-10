<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
       @yield('title')
    </title>
  <!-- BOOTSTRAP STYLES-->

      {{ HTML::style('/theme/assets/css/bootstrap.css'); }}
      <!-- <link href="<?php echo  Request::root();?>/theme/assets/css/bootstrap.css" rel="stylesheet" /> -->
      <!-- FONTAWESOME STYLES-->
      {{ HTML::style('/theme/assets/css/font-awesome.css'); }}
      <!-- <link href="<?php echo  Request::root();?>/theme/assets/css/font-awesome.css" rel="stylesheet" /> -->
      <!-- CUSTOM STYLES-->
      {{ HTML::style('/theme/assets/css/custom.css'); }}
      <!-- <link href="<?php echo  Request::root();?>/theme/assets/css/custom.css" rel="stylesheet" /> -->
      <!-- GOOGLE FONTS-->
      {{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans'); }}
      <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->

</head>
<body>

    @yield('content')
    
     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    {{ HTML::script('/theme/assets/js/jquery-1.10.2.js'); }}
    <!--script src="<?php echo  Request::root();?>/theme/assets/js/jquery-1.10.2.js"></script-->
      <!-- BOOTSTRAP SCRIPTS -->
      {{ HTML::script('/theme/assets/js/bootstrap.min.js'); }}
    <!--script src="<?php echo  Request::root();?>/theme/assets/js/bootstrap.min.js"></script-->
    <!-- METISMENU SCRIPTS -->
    {{ HTML::script('/theme/assets/js/jquery.metisMenu.js'); }}
    <!--script src="<?php echo  Request::root();?>/theme/assets/js/jquery.metisMenu.js"></script-->
      <!-- CUSTOM SCRIPTS -->
      {{ HTML::script('/theme/assets/js/custom.js'); }}
    <!--script src="<?php echo  Request::root();?>/theme/assets/js/custom.js"></script-->
    <!-- My CUSTOM SCRIPTS -->
    {{ HTML::script('/theme/assets/js/laravel_todo.js'); }}
    <!--Form Validator-->
    {{ HTML::script('/theme/assets/js/BootstrapValidator.min.js'); }}
   
</body>
</html>
