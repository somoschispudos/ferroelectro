<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    @media print
    {
    .no-print, .no-print *
    {
    display: none !important;
    }
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

            <div class="row no-print">
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
                        <h4 class="card-title mb-4">Pending payments</h4>
                        <h4 class="card-title mb-4 no-print"><a href="javascript:void(0)" onClick="window.print()" class="btn btn-info">PRINT DOCUMENT</a></h4>
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>CODE</th>
                                        <th class="no-print">DATE CREATED</th>
                                        <th>SHIPPER</th>
                                        <th>DESTINATION</th>
                                        <th>AMMOUNT</th>
                                        <th class="no-print"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($payments as $p){
                                    ?>
                                    <tr style="color: #6e747a;">
                                        <td style="width: 120px;"><?= $p['code'] ?></td>
                                        <td class="no-print" style="width: 110px; text-align: center;">
                                            <?php
                                                $datecreated = date('m-d-Y', strtotime($p['date_created']));
                                                echo $datecreated;
                                            ?>
                                        </td>
                                        <td><?= $p['shipper'] ?></td>
                                        <td><?= $p['destination'] ?></td>
                                        <td style="text-align: right; width: 130px;">$<?= number_format($p['rate'], 2, '.', ',') ?></td>
                                        <td class="no-print" style="text-align: center; width: 40px;">
                                            <span class="badge rounded-pill badge-outline-secondary">PENDING</span>
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