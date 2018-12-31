<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//echo base_url();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrador</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url()?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="<?=base_url()?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=base_url()?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?=base_url()?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/jquery.fileupload.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>build/css/custom.min.css" rel="stylesheet">
    
    <style>
    select[multiple], select[size] {
    height: 250px;
    }
		/*datepicker*/
		option.ui-datepicker {
    display: none;
    padding: 0.2em 0.2em 0;
    width: 17em;
}
.ui-datepicker .ui-datepicker-header {
    padding: 0.2em 0;
    position: relative;
		background-color:#DEEBF5;
		width:280px;
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
    height: 1.8em;
    position: absolute;
    top: 2px;
    width: 1.8em;
}
.ui-datepicker .ui-datepicker-prev-hover, .ui-datepicker .ui-datepicker-next-hover {
    top: 1px;
}
.ui-datepicker .ui-datepicker-prev {
    left: 2px;
}
.ui-datepicker .ui-datepicker-next {
    right: 2px;
}
.ui-datepicker .ui-datepicker-prev-hover {
    left: 1px;
}
.ui-datepicker .ui-datepicker-next-hover {
    right: 1px;
}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
    display: block;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    position: absolute;
    top: 50%;
}
.ui-datepicker .ui-datepicker-title {
    line-height: 1.8em;
    margin: 0 2.3em;
    text-align: center;
}
.ui-datepicker .ui-datepicker-title select {
    font-size: 1em;
    margin: 1px 0;
}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
    width: 45%;
}
.ui-datepicker table {
    border-collapse: collapse;
    font-size: 0.9em;
    margin: 0 0 0.4em;
    width: 100%;
		background-color:#DEEBF5;
}
.ui-datepicker th {
    border: 0 none;
    font-weight: bold;
    padding: 0.7em 0.3em;
    text-align: center;
}
.ui-datepicker td {
    border: 0 none;
    padding: 1px;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: 0.2em;
    text-align: right;
    text-decoration: none;
}
.ui-datepicker .ui-datepicker-buttonpane {
    background-image: none;
    border-bottom: 0 none;
    border-left: 0 none;
    border-right: 0 none;
    margin: 0.7em 0 0;
    padding: 0 0.2em;
}
.ui-datepicker .ui-datepicker-buttonpane button {
    cursor: pointer;
    float: right;
    margin: 0.5em 0.2em 0.4em;
    overflow: visible;
    padding: 0.2em 0.6em 0.3em;
    width: auto;
}
.ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
    float: left;
}
.ui-datepicker.ui-datepicker-multi {
    width: auto;
}
.ui-datepicker-multi .ui-datepicker-group {
    float: left;
}
.ui-datepicker-multi .ui-datepicker-group table {
    margin: 0 auto 0.4em;
    width: 95%;
}
.ui-datepicker-multi-2 .ui-datepicker-group {
    width: 50%;
}
.ui-datepicker-multi-3 .ui-datepicker-group {
    width: 33.3%;
}
.ui-datepicker-multi-4 .ui-datepicker-group {
    width: 25%;
}
.ui-datepicker-multi .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-multi .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 0;
}
.ui-datepicker-multi .ui-datepicker-buttonpane {
    clear: left;
}
.ui-datepicker-row-break {
    clear: both;
    font-size: 0;
    width: 100%;
}
.ui-datepicker-rtl {
    direction: rtl;
}
.ui-datepicker-rtl .ui-datepicker-prev {
    left: auto;
    right: 2px;
}
.ui-datepicker-rtl .ui-datepicker-next {
    left: 2px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-prev:hover {
    left: auto;
    right: 1px;
}
.ui-datepicker-rtl .ui-datepicker-next:hover {
    left: 1px;
    right: auto;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane {
    clear: right;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button {
    float: left;
}
.ui-datepicker-rtl .ui-datepicker-buttonpane button.ui-datepicker-current, .ui-datepicker-rtl .ui-datepicker-group {
    float: right;
}
.ui-datepicker-rtl .ui-datepicker-group-last .ui-datepicker-header, .ui-datepicker-rtl .ui-datepicker-group-middle .ui-datepicker-header {
    border-left-width: 1px;
    border-right-width: 0;
}
.ui-datepicker .ui-icon {
    background-repeat: no-repeat;
    display: block;
    left: 0.5em;
    overflow: hidden;
    text-indent: -99999px;
    top: 0.3em;
}
    </style>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <?php $this->load->view("menu_izq"); ?>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <?php $this->load->view("menu_top"); ?>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>