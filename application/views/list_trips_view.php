<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .code-error{
        display: none;
    }

    label {
        margin-top: 5px;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

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
                <div class="col-xl-3 col-sm-6">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" style="overflow: hidden;">
                                <div>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="text-align: left;">
                                        Date Start
                                    </h4>
                                    <p style="text-align: center; font-size: 1rem;"><?= date('M-d-Y', strtotime($activelist[0]['date_created'])) ?></p>
                                </div>
                                <div>
                                    <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" style="text-align: left;">
                                        Odometer Start
                                    </h4>
                                    <p style="text-align: center; font-size: 1rem;"><?= number_format($activelist[0]['miles_start'], 0, '', ',') ?> miles</p>
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
                            <h4 class="card-title mb-4">Trips</h4>
                            <div class="justify-content-between">
                                <a href="<?= base_url('trips/' . $activelist[0]['iduser']) ?>" class="btn btn-secondary">BACK TO LISTS</a></h4>
                                <?php
                                if($activelist[0]['liststatus'] == 0){
                                ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target=".modal-trips" class="btn btn-primary">NEW TRIP</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>SHIPPER</th>
                                        <th>FROM</th>
                                        <th>DESTINATION</th>
                                        <th>TO</th>
                                        <th>STOPS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($trips as $t){
                                    ?>
                                    <tr>
                                        <td style="width: 110px; text-align: center;"><?= date('m-d-Y', strtotime($t['date'])) ?></td>
                                        <td><?= $t['shipper'] ?></td>
                                        <td><?= $t['fromcity'] . ', CA' ?></td>
                                        <td><?= $t['destination'] ?></td>
                                        <td><?= $t['tocity'] . ', CA' ?></td>
                                        <td style="text-align: center; width: 60px; position: relative;">
                                            <?= $t['stops'] ?>
                                            <?php
                                            if($t['notes'] != ''){
                                            ?>
                                            <a href="#" data-bs-toggle="modal" data-bs-target=".modal-notes" data-note="<?= $t['notes'] ?>"><img src="<?= base_url('assets/images/notes.svg') ?>" style="width: 20px; position: absolute; top: 5px; right: 5px;" /></a>
                                            <?php
                                            }
                                            ?>
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
                            <h4 class="card-title mb-4">Fuel / IFTA Reporting</h4>
                            <div class="justify-content-between">
                                <?php
                                if($activelist[0]['liststatus'] == 0){
                                ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target=".modal-fuel" class="btn btn-primary">NEW FUEL REPORT</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>STATION</th>
                                        <th>CITY / STATE</th>
                                        <th>TRUCK / REFER</th>
                                        <th>GALLONS</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($fuel as $f){
                                    ?>
                                    <tr>
                                        <td style="width: 110px; text-align: center;"><?= date('m-d-Y', strtotime($f['date'])) ?></td>
                                        <td><?= $f['station'] ?></td>
                                        <td><?= $f['city'] . ', CA' ?></td>
                                        <td style="text-align: center; width: 130px;"><span class="badge rounded-pill badge-outline-<?= ($f['option'] == 'TRUCK')?'success':'primary' ?>"><?= $f['option'] ?></span></td>
                                        <td style="text-align: center; width: 120px;"><?= number_format($f['gallons'], 2, '.', ',') ?></td>
                                        <td style="text-align: right; width: 120px;">$<?= number_format($f['total'], 2, '.', ',') ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td style="text-align: center; width: 120px; font-weight: bold;"><?= number_format($totalgallons[0]['gallons'], 2, '.', ',') ?></td>
                                        <td style="text-align: right; width: 120px; font-weight: bold;">$<?= number_format($totalmoney[0]['total'], 2, '.', ',') ?></td>
                                    </tr>
                                </tfoot>
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
                        <div class="justify-content-between">

                            <h4 class="card-title mb-4">Expenses</h4>
                            <div class="justify-content-between">
                                <?php
                                if($activelist[0]['liststatus'] == 0){
                                ?>
                                <a href="#" data-bs-toggle="modal" data-bs-target=".modal-expenses" class="btn btn-primary">NEW EXPENSE</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-striped table-bordered table-condensed table-hovered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>CITY / STATE</th>
                                        <th>PURPOSE</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($expenses as $e){
                                    ?>
                                    <tr>
                                        <td style="width: 110px; text-align: center;"><?= date('m-d-Y', strtotime($e['date'])) ?></td>
                                        <td><?= $e['city'] . ', CA' ?></td>
                                        <td><?= $e['purpose'] ?></td>
                                        <td style="text-align: right; width: 120px;">$<?= number_format($e['total'], 2, '.', ',') ?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td style="text-align: right; width: 120px; font-weight: bold;">$<?= number_format($totalexpenses[0]['total'], 2, '.', ',') ?></td>
                                    </tr>
                                </tfoot>
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

    <div class="modal fade modal-trips" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new trip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row form-group">
                            <div class="col-xl-6 col-sm-6">
                                <label class="form-label">Date</label>
                                <input id="litepicker-1" type="text" value="<?= date('m-d-Y') ?>" class="form-control" required="required" name="date" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <label class="form-label">Stops</label>
                                <input type="number" class="form-control inputcode focustrip" required="required" name="stops" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Shipper</label>
                                <input type="text" class="form-control" required="required" name="shipper" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label class="form-label">City</label>
                                <select id="select-beast-1" placeholder="Select a city..." autocomplete="off" name="fromcity">
                                    <option value=""></option>
                                    <?php
                                    foreach($cities as $c){
                                    ?>
                                    <option value="<?= $c['city'] ?>"><?= $c['city'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-6 form-group">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" disabled="disabled" value="California" required="required" name="fromstate" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Destination</label>
                                <input type="text" class="form-control" required="required" name="destination" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label class="form-label">City</label>
                                <select class="form-control" name="tocity">
                                    <?php
                                    foreach($cities as $c){
                                    ?>
                                    <option value="<?= $c['city'] ?>"><?= $c['city'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-6 form-group">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" disabled="disabled" value="California" required="required" name="tostate" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="savetrip" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade modal-notes" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="thisnote"></p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade modal-fuel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new fuel report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row form-group">
                            <div class="col-xl-6 col-sm-6">
                                <label class="form-label">Date</label>
                                <input id="litepicker-2" type="text" value="<?= date('m-d-Y') ?>" class="form-control" required="required" name="date" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Station name</label>
                                <input type="text" class="form-control focusfuel" required="required" name="station" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label class="form-label">City</label>
                                <select class="form-control" name="city">
                                    <?php
                                    foreach($cities as $c){
                                    ?>
                                    <option value="<?= $c['city'] ?>"><?= $c['city'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-6 form-group">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" disabled="disabled" value="California" required="required" name="state" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Truck / Refer</label>
                                <div class="d-flex justify-content-between col-md-4">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="option" value="TRUCK" id="formRadios1" checked="checked">
                                        <label class="form-check-label" for="formRadios1">
                                            Truck
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="option" value="REFER" id="formRadios2">
                                        <label class="form-check-label" for="formRadios2">
                                            Refer
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xl-6">
                                <label class="form-label">Gallons</label>
                                <input type="text" class="form-control" required="required" name="gallons" autocomplete="off">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Total</label>
                                <input type="text" style="text-align: right;" class="form-control currency" required="required" name="total" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="savefuel" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade modal-expenses" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new expense report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row form-group">
                            <div class="col-xl-6 col-sm-6">
                                <label class="form-label">Date</label>
                                <input id="litepicker-3" type="text" value="<?= date('m-d-Y') ?>" class="form-control" required="required" name="date" autocomplete="off">
                            </div>
                            <div class="col-xl-6 form-group">
                                <label>Total</label>
                                <input type="text" style="text-align: right;" class="form-control currency focusexpenses" required="required" name="total" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group">
                                <label class="form-label">City</label>
                                <select class="form-control" name="city">
                                    <?php
                                    foreach($cities as $c){
                                    ?>
                                    <option value="<?= $c['city'] ?>"><?= $c['city'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-6 form-group">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" disabled="disabled" value="California" required="required" name="state" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 form-group">
                                <label class="form-label">Purpose</label>
                                <input type="text" class="form-control" required="required" name="purpose" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <button type="submit" name="saveexpenses" class="btn btn-primary btn-block">SAVE</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        const picker1 = new Litepicker({
            element: document.getElementById('litepicker-1'),
            format: "MM-DD-YYYY"
        });

        const picker2 = new Litepicker({
            element: document.getElementById('litepicker-2'),
            format: "MM-DD-YYYY"
        });

        const picker3 = new Litepicker({
            element: document.getElementById('litepicker-3'),
            format: "MM-DD-YYYY"
        });

        new TomSelect("#select-beast-1",{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    </script>