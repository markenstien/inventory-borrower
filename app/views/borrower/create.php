<?php build('content') ?>
<div class="col-md-6">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Borrower</h4>
                <?php echo wLinkDefault(_route('borrow:index'), 'Borrows')?>
            </div>

            <div class="card-body">
                <?php Flash::show()?>
                <?php echo $form->start()?>
                    <div class="form-group">
                        <?php echo $form->getCol('borrower');?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('item_id');?>
                    </div>

                    <section class="mt-2" style="border: 1px solid #000;padding:10px">
                        <h5>Borrow Details</h5>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><?php echo $form->getCol('borrow_date');?></div>
                                <div class="col-md-6"><?php echo $form->getCol('borrow_time');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><?php echo $form->getCol('borrow_state');?></div>
                                <div class="col-md-6"><?php echo $form->getCol('return_to_date');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->getCol('borrow_remark');?>
                        </div>
                    </section>

                    <div class="form-group">
                        <?php echo $form->getCol('status');?>
                        <p>If set to on-going, this will automatically create logs on item</p>
                    </div>
                    <div class="form-group mt-2">
                        <?php Form::submit('', 'Save Borrow Data')?>
                    </div>
                <?php echo $form->end()?>
            </div>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo()?>