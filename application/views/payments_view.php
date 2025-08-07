<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title ?></h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <h6 class="font-size-xs text-uppercase"><?= date('Y') ?> payments</h6>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center">
                                        $<?= number_format($rev_year[0]['rate'], 2, '.', ',') ?>
                                    </h4>
                                    <div class="text-muted">Earnings this year</div>
                                </div>
                                <div>
                                    <img src="<?= base_url('assets/images/business-and-finance.png') ?>" style="width: 110px;" />
                                </div>
                            </div>
                            <!-- <div class="apex-charts mt-3" id="sparkline-chart-1"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <h6 class="font-size-xs text-uppercase"><?= date('M-Y') ?> payments</h6>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center">
                                        $<?= number_format($rev_month[0]['rate'], 2, '.', ',') ?>
                                    </h4>
                                    <div class="text-muted">Earnings this month</div>
                                </div>
                                <div>
                                    <img src="<?= base_url('assets/images/business-and-finance.png') ?>" style="width: 110px;" />
                                </div>
                            </div>
                            <!-- <div class="apex-charts mt-3" id="sparkline-chart-1"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <h6 class="font-size-xs text-uppercase">Pending</h6>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center">
                                        $<?= number_format($rev_pending[0]['rate'], 2, '.', ',') ?>
                                    </h4>
                                    <div class="text-muted">Pending payments</div>
                                </div>
                                <div>
                                    <img src="<?= base_url('assets/images/online-payment.png') ?>" style="width: 110px;" />
                                </div>
                            </div>
                            <!-- <div class="apex-charts mt-3" id="sparkline-chart-1"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <h6 class="font-size-xs text-uppercase">Gasoline</h6>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center">
                                        $<?= number_format($rev_month[0]['rate'], 2, '.', ',') ?>
                                    </h4>
                                    <div class="text-muted">Gasoline</div>
                                </div>
                                <div>
                                    <img src="<?= base_url('assets/images/gasoline.png') ?>" style="width: 110px;" />
                                </div>
                            </div>
                            <!-- <div class="apex-charts mt-3" id="sparkline-chart-1"></div> -->
                        </div>
                    </div>
                </div>
            </div> <!-- end row-->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <h4 class="card-title mb-4"><a href="#" data-bs-toggle="modal"
                                        data-bs-target=".bs-example-modal-center" class="btn btn-primary">NEW PAYMENT</a></h4>
                            <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-condensed table-hovered payswitch" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th>DATE CREATED</th>
                                        <th>DATE PAID</th>
                                        <th>SHIPPER</th>
                                        <th>DESTINATION</th>
                                        <th>AMMOUNT</th>
                                        <th>PAID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($payments as $p){
                                    ?>
                                    <tr class="thisrow<?= $p['id'] ?> <?= ($p['status'] == 0)?'':'table-success' ?>" style="<?= ($p['status'] == 0)?'color: #6e747a;':'color: green;' ?>">
                                        <td style="width: 120px;"><?= $p['code'] ?></td>
                                        <td style="width: 110px; text-align: center;">
                                            <?php
                                                $datecreated = date('m-d-Y', strtotime($p['date_created']));
                                                echo $datecreated;
                                            ?>
                                        </td>
                                        <td style="width: 110px; text-align: center;" class="datepaid">
                                            <?= ($p['status'] == 0)?'##-##-####':$p['date_paid'] ?>
                                        </td>
                                        <td><?= $p['shipper'] ?></td>
                                        <td><?= $p['destination'] ?></td>
                                        <td style="text-align: right; width: 130px;">$<?= number_format($p['rate'], 2, '.', ',') ?></td>
                                        <td style="text-align: center; width: 40px;">
                                            <div class="form-check form-switch form-switch-md mb-2">
                                                <input class="form-check-input paid" type="checkbox" data-status="<?= ($p['status'] == 0)?'0':'1' ?>" data-id="<?= $p['id'] ?>" <?= ($p['status'] == 0)?'':'checked="checked"' ?> >
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div><!-- end table responsive -->
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                    <div class="alert alert-warning code-error" role="alert">Careful! You are entering a code that already exists.</div>
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <label class="form-label">Code</label>
                                <input id="mytext" type="text" class="form-control inputcode" required="required" name="code" autocomplete="off">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Ammount</label>
                                <input type="text" style="text-align: right;" class="form-control currency" required="required" name="ammount" autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Shipper</label>
                                <input type="text" class="form-control" required="required" name="shipper" autocomplete="off">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Destination</label>
                                <input type="text" class="form-control" required="required" name="destination" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="save" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->