<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Borrow Info</h4>
            <?php echo wLinkDefault(_route('borrow:edit', $borrow->id), 'Edit')?>
        </div>
        
        <div class="card-body">

            <?php if(isEqual($borrow->status,'cancelled')) :?>
                <?php echo wLinkDefault(_route('borrow:delete', $borrow->id, [
                    'route' => seal(_route('borrow:index'))
                ]), 'Delete Cancelled Record', [
                    'class' => 'btn btn-danger btn-lg form-verify'
                ])?>
            <?php endif?>
            <div class="row">
                <div class="col-md-6">
                    <h4>Borrow Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Reference</td>
                                <td><?php echo $borrow->reference?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span class="badge bg-info"><?php echo $borrow->status?></span></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('borrow_date')?> : </td>
                                <td><?php echo $borrow->borrow_date?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('borrow_time')?> :</td>
                                <td><?php echo $borrow->borrow_time?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('return_on_date')?></td>
                                <td><?php echo $borrow->return_on_date?></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="background-color: blue;color:#fff">Item Borrowed</td>
                            </tr>
                            <tr>
                                <td>Item Name</td>
                                <td><?php echo $borrow->item_name?></td>
                            </tr>
                            <tr>
                                <td>Borrowed Condition</td>
                                <td><?php echo $borrow->borrow_state?></td>
                            </tr>
                            <tr>
                                <td>Borrowed Remarks:</td>
                                <td><p><?php echo $borrow->borrow_remark?></p></td>
                            </tr>
                        </table>
                    </div>

                    <?php if(empty($borrow->return_date)) :?>
                    <div>
                        <a href="<?php echo _route('borrow:return-item', $borrow->id)?>" class="btn btn-primary btn-lg mt-3">Return Borrowed Equipment</a>
                    </div>
                    <?php endif?>


                    <?php if(!empty($borrow->return_date)) :?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="2" style="background-color: blue;color:#fff">Return Details</td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('return_date')?></td>
                                <td><?php echo $borrow->return_on_date?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('return_state')?></td>
                                <td><?php echo $borrow->return_state?></td>
                            </tr>
                            <tr>
                                <td><?php echo $form->getLabel('return_remark')?>:</td>
                                <td><p><?php echo $borrow->return_remark?></p></td>
                            </tr>
                        </table>
                    </div>
                    <?php endif?>
                </div>

                <div class="col-md-6">
                    <h4>Borrower</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Name</td>
                                <td><?php echo $borrow->borrower_name?></td>
                            </tr>
                            <tr>
                                <td>Identification number</td>
                                <td><?php echo $borrow->user_identification?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>