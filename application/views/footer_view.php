<footer class="footer" style="background-color: #fff;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> &copy; FerroElectro.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Hecho por <a href="http://edwinorellana.com/" target="_blank" class="text-reset"><img src="<?= base_url('assets/images/krc.png') ?>" /></a>
                </div>
            </div>
        </div>
    </div>
</footer>
            <!-- </div> -->
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="<?= base_url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/libs/metismenujs/metismenujs.min.js') ?>"></script>
        <script src="<?= base_url('assets/libs/simplebar/simplebar.min.js') ?>"></script>
        <script src="<?= base_url('assets/libs/feather-icons/feather.min.js') ?>"></script>

        <!-- apexcharts -->
        <!-- <script src="<?= base_url('assets/libs/apexcharts/apexcharts.min.js') ?>"></script> -->

        <!-- Vector map-->
        <!-- <script src="<?= base_url('assets/libs/jsvectormap/js/jsvectormap.min.js') ?>"></script>
        <script src="<?= base_url('assets/libs/jsvectormap/maps/world-merc.js') ?>"></script>
        <script src="<?= base_url('assets/js/pages/dashboard-sales.init.js') ?>"></script> -->


        <!-- plugins -->
        <!-- <script src="<?= base_url('assets/libs/choices.js/public/assets/scripts/choices.min.js') ?>"></script> -->
        <script src="<?= base_url('assets/libs/flatpickr/flatpickr.min.js') ?>"></script>
        <!--<script type="text/javascript" src="https://cdn.rawgit.com/flouthoc/minAjax.js/master/minify/index.min.js"></script>-->
        <script src="<?= base_url('assets/js/minajax.js') ?>"></script>

        <!-- <script src="<?= base_url('assets/libs/@simonwep/pickr/pickr.min.js') ?>"></script> -->
        <!-- init js -->
        <!-- <script src="<?= base_url('assets/js/pages/form-advanced.init.js') ?>"></script> -->

        <!-- <script src="@@path/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script> -->

        <script src="<?= base_url('assets/js/app.js') ?>"></script>


        <!-- <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
        <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> -->




        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"> -->
        <script src="<?= base_url('fileupload/jquery.fileuploader.min.js') ?>" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.5.1/math.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script> -->

        <script>
            $(document).ready(function (){
                let base = '<?= base_url() ?>';

                $('input.files').fileuploader({
                    limit: null,
                    addMore: true,
                    captions: 'es'
                });

                $('.bs-example-modal-center').on('shown.bs.modal', function() {
                    $('#mytext').focus();
                });

                $('.modal-trips').on('shown.bs.modal', function() {
                    $('.focustrip').focus();
                });

                $('.modal-fuel').on('shown.bs.modal', function() {
                    $('.focusfuel').focus();
                });

                $('.modal-expenses').on('shown.bs.modal', function() {
                    $('.focusexpenses').focus();
                });

                $('.modal-tripstart').on('shown.bs.modal', function() {
                    $('.odo-start').focus();
                });

                $('.modal-tripend').on('shown.bs.modal', function() {
                    $('.odo-end').focus();
                    var idlist = $(e.relatedTarget).data('idlist');
                });

                $('.modal-notes').on('shown.bs.modal', function(e) {
                    var note = $(e.relatedTarget).data('note');
                    $(e.currentTarget).find('.thisnote').html(note);
                });

                $('#myTable').DataTable();
                $('#clientSearch').DataTable({
                    ordering: true,
                    order: [[0, 'desc']],
                });
                $('#movimientosbancos').DataTable({
                    ordering: true,
                    order: [[1, 'desc']],
                });

                $('.currencydollar').maskMoney({
                    prefix: '$'
                });

                $('.currencyquet').maskMoney({
                    prefix: 'Q'
                });

                $('.payswitch').delegate('.paid', 'click', function(){
                    let id = $(this).data('id');
                    let status = $(this).data('status');
                    let obj = $(this);

                    minAjax({
                        url: base + 'payments/paid',
                        type:"POST",
                        data:{
                            id:id,
                            status: status
                        },

                        success: function(data){

                            if(data === '##-##-####'){
                                obj.data('status', '0');
                                $('.thisrow'+id).removeClass('table-success').css('color', '#6e747a');
                            }else{
                                obj.data('status', '1')
                                $('.thisrow'+id).addClass('table-success').css('color', 'green');
                            }

                            obj.parent().parent().parent().find('.datepaid').text(data);
                        }
                    });
                });

                $('.inputcode').on('keyup', function(){
                    let code = $(this).val();

                    minAjax({
                        url: base + 'payments/check_code',
                        type:"POST",
                        data:{
                            code: code
                        },

                        success: function(data){
                            if(data === '0'){
                                $('.code-error').hide();
                            }else{
                                $('.code-error').show();
                            }
                        }
                    });
                });

                $('.js-example-basic-single').select2();
            });
        </script>
    </body>
</html>
