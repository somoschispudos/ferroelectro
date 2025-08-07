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
                                    <img src="<?= base_url('assets/images/driver.svg') ?>" style="width: 110px;" />
                                </div>
                                <div>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="text-align: right;">
                                        <?= $driver ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <img src="<?= base_url('assets/images/cargo.png') ?>" style="width: 110px;" />
                                </div>
                                <div>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="text-align: right;">
                                        Tractor <?= $tractor ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <img src="<?= base_url('assets/images/semi.png') ?>" style="width: 110px;" />
                                </div>
                                <div>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="text-align: right;">
                                        Truck <?= $truck ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row-->


            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <?php
                                if(empty($activelist)){
                            ?>
                            <h4 class="card-title mb-4"><a href="#" data-bs-toggle="modal" data-bs-target=".modal-tripstart" class="btn btn-primary">NEW LIST</a></h4>
                            <?php
                                }
                            ?>
                            <div class="table-responsive">
                            <table class="table table-condensed table-bordered border-success" style="width:100%">
                                <thead style="color: green; background-color: #DCF6E8;">
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">DATE START</th>
                                        <th style="text-align: center;">ODOMETER START</th>
                                        <th style="text-align: center;">STATUS</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($activelist)){
                                    ?>
                                    <tr style="font-weight: bold; font-size: 1.5rem; color: #50d28c;">
                                        <td style="text-align: center;"><?= $activelist[0]['id'] ?></td>
                                        <td style="text-align: center;"><?= date('M-d-Y', strtotime($activelist[0]['date_created'])) ?></td>
                                        <td style="text-align: center;"><?= number_format($activelist[0]['miles_start'], 0, '', ',') . ' miles' ?></td>
                                        <td style="text-align: center; width: 120px;"><span class="badge rounded-pill badge-outline-success">IN PROGRESS</span></td>
                                        <td style="text-align: center; width: 40px;">
                                            <a href="<?= base_url('trips/list_trips/' . $activelist[0]['id']) ?>" class="btn btn-outline-success"><img src="<?= base_url('assets/images/file.svg') ?>" style="width: 35px;"></a>
                                        </td>
                                        <td style="text-align: center; width: 40px;">
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".modal-tripend" class="btn btn-outline-warning"><img src="<?= base_url('assets/images/finish.svg') ?>" style="width: 35px;"></a>
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

            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">DATE START</th>
                                        <th style="text-align: center;">ODOMETER START</th>
                                        <th style="text-align: center;">DATE END</th>
                                        <th style="text-align: center;">ODOMETER END</th>
                                        <th style="text-align: center;">STATUS</th>
                                        <th style="text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($lists as $l){
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $l['id'] ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                                $datecreated = date('m-d-Y', strtotime($l['date_created']));
                                                echo $datecreated;
                                            ?>
                                        </td>
                                        <td style="text-align: center;" class="datepaid">
                                            <?= $l['miles_start'] ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                                $dateend = date('m-d-Y', strtotime($l['date_ended']));
                                                echo $dateend;
                                            ?>
                                        </td>
                                        <td style="text-align: center;" class="datepaid">
                                            <?= $l['miles_end'] ?>
                                        </td>
                                        <td style="text-align: center; width: 110px;" class="datepaid">
                                            <?php
                                            if($l['liststatus'] == 1){
                                            ?>
                                            <span class="badge rounded-pill badge-outline-secondary">PENDING PAYMENT</span>
                                            <?php
                                            }elseif($l['liststatus'] == 2){
                                            ?>
                                            <span class="badge rounded-pill badge-outline-success">PAID</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center; width: 40px;">
                                            <a href="<?= base_url('trips/list_trips/' . $l['id']) ?>" class="btn btn-outline-success btn-sm"><img src="<?= base_url('assets/images/file.svg') ?>" style="width: 20px;"></a>
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

    <div class="modal fade modal-tripstart" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Start List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row form-group">
                            <div class="col-xl-6 col-sm-6">
                                <label class="form-label">Date</label>
                                <input id="litepicker" type="text" value="<?= date('m-d-Y') ?>" class="form-control" required="required" name="date" autocomplete="off">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Odometer start</label>
                                <input type="number" class="form-control odo-start" required="required" name="odometer" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="savestart" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade modal-tripend" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">End List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <?php
                        if(!empty($activelist)){
                        ?>
                        <input type="hidden" name="idlist" value="<?= $activelist[0]['id'] ?>" />
                        <?php
                        }
                        ?>
                        <div class="row form-group">
                            <div class="col-xl-6 col-sm-6">
                                <label class="form-label">Date</label>
                                <input id="litepicker" type="text" value="<?= date('m-d-Y') ?>" class="form-control" required="required" name="date" autocomplete="off">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Odometer end</label>
                                <input type="number" class="form-control odo-end" required="required" name="odometer" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="saveend" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->