<?php build('content') ?>
<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Return Borrowed Item</h4>
            <?php echo wLinkDefault(_route('borrow:show', $id), 'Back to view')?>
        </div>
        <div class="card-body">
            <?php echo $form->start(['action' => _route('borrow:return-item', $id)])?>
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
            <?php Form::submit('', 'Save Borrow Data')?>
            <?php echo $form->end()?>
        </div>
    </div>
</div>
<?php endbuild()?>
<?php loadTo()?>