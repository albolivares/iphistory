<!-- footer content -->
        <?php include("footer.php"); ?>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url()?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?=base_url()?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?=base_url()?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url()?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?=base_url()?>vendors/iCheck/icheck.min.js"></script>
    <!-- Parsley -->
    <script src="<?=base_url()?>vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Skycons -->
    <script src="<?=base_url()?>vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?=base_url()?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?=base_url()?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?=base_url()?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?=base_url()?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?=base_url()?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?=base_url()?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?=base_url()?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Datatables -->
    <script src="<?=base_url()?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?=base_url()?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- <script src="<?=base_url()?>vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Datatables -->
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>build/js/custom.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="<?=base_url()?>assets/js/start_script.js"></script>

    <?php
    if (isset($js)) {
        foreach ($js as $j) {
          echo '<script src="' . base_url(). 'assets/js/' . $j . '"></script>';
        }
    }

    ?>

  </body>
</html>
