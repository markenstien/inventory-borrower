<?php build('content') ?>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Report Management</h4>
            </div>

            <div class="card-body">
                <?php echo $_formCommon->start()?>
                    <?php echo $_formCommon->getCol('start_date') ?>
                    <?php echo $_formCommon->getCol('end_date') ?>

                    <div class="form-group mt-2">
                        <?php Form::submit('btn_report', 'Create Report')?>
                    </div>
                <?php echo $_formCommon->end()?>
            </div>
        </div>
    </div>
<?php endbuild()?>

<?php loadTo()?>