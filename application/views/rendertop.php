<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo base_url();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registro de solicitudes</title>
   
    <input type="text" name="hidden_user_id" id="hidden_user_id" hidden value="1">
    
    <!-- Bootstrap -->
    <link href="<?=base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- iCheck -->
    <link href="<?=base_url()?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
     <!-- jQueryFileUpload -->
    
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url()?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?=base_url()?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>/assets/css/movimiento.css">
    <link href="<?=base_url()?>assets/css/jquery.fileupload.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/multi-select.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>build/css/custom.min.css" rel="stylesheet">   
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container ">
        <div class="col-md-3 left_col menu_fixed" >
          <?php include("menu_izq.php"); ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <?php include("menu_top.php"); ?>
        </div>
        <!-- /top navigation -->

        