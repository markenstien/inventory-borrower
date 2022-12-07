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
                <?php echo $form->start(['action' => _route('borrow:edit', $id)])?>
                    <div class="form-group">
                        <?php echo $form->getCol('borrower', [
                            'value' => $borrow->user_identification
                        ]);?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('item_id');?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('status');?>
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
                                <div class="col-md-6"><?php echo $form->getCol('borrow_remark');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->getCol('return_on_date');?>
                        </div>
                    </section>

                    <!-- if return is already set -->
                    <section class="mt-2" style="border: 1px solid #000;padding:10px">
                        <h5>Return Details</h5>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><?php echo $form->getCol('return_date');?></div>
                                <div class="col-md-6"><?php echo $form->getCol('return_time');?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><?php echo $form->getCol('return_state');?></div>
                                <div class="col-md-6"><?php echo $form->getCol('return_remark');?></div>
                            </div>
                        </div>
                    </section>

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