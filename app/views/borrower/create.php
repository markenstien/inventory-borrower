<?php

use function PHPSTORM_META\map;

 build('content') ?>
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
                        <?php 
                            if(isEqual(whoIs('user_type'), 'student')) 
                            {
                                echo $form->getCol('borrower', [
                                    'value' => whoIs(['firstname' , 'lastname']),
                                ]);
                                
                                Form::hidden('borrower_id', whoIs('id'), [
                                    'id' => 'borrowerId'
                                ]);
                            } else {
                                echo $form->getCol('borrower');
                                echo wLinkDefault('#', 'Manual Search', [
                                    'id' => 'user_manual_search',
                                    'data-bs-toggle' => 'modal',
                                    'data-bs-target' => '#userManualSearchModal'
                                ]);

                                Form::hidden('borrower_id','', [
                                    'id' => 'borrowerId'
                                ]);
                            }
                        ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->getCol('item_barcode_search');?>
                        <?php echo wLinkDefault('#', 'Manual Search', [
                            'id' => 'item_manual_search',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#itemManualSearchModal'
                        ])?>

                        <?php Form::hidden('item_id','', [
                            'id' => 'itemId'
                        ])?>
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
                                <div class="col-md-6"><?php echo $form->getCol('return_on_date');?></div>
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

<!--- 
    MODALS
-->
<div class="modal fade" id="userManualSearchModal" tabindex="-1" aria-labelledby="userManualSearchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userManualSearchModalLabel">Users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Select</th>
                </thead>

                <tbody>
                    <?php foreach($users as $key => $row) :?>
                        <tr>
                            <td><?php echo ++$key?></td>
                            <td><?php echo $row->username?></td>
                            <td><?php echo $row->firstname . ' ' .$row->lastname?></td>
                            <td><a href="#" data-id="<?php echo $row->id?>" data-name="<?php echo $row->firstname . ' ' . $row->lastname?>" data-type="user" class="select">Select</a></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="itemManualSearchModal" tabindex="-1" aria-labelledby="itemManualSearchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="itemManualSearchModalLabel">Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Total Stocks</th>
                    <th>Select</th>
                </thead>

                <tbody>
                    <?php foreach($items as $key => $row) :?>
                        <tr>
                            <td><?php echo ++$key?></td>
                            <td><?php echo $row->name?></td>
                            <td><?php echo $row->total_stock?></td>
                            <td><a href="#" data-id="<?php echo $row->id?>" data-name="<?php echo $row->name?>" data-type="item" class="select">Select</a></td>
                        </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endbuild()?>

<?php build('scripts')?>
    <script>
        $(document).ready(function() {
            $('.select').click(function() {
                let dataType = $(this).data('type'),
                dataName = $(this).data('name');
                dataId = $(this).data('id');

                if(dataType == 'user') {
                    $("#borrower").val(dataName);
                    $("#borrowerId").val(dataId);
                }

                if(dataType == 'item') {
                    $("#itemBarSearch").val(dataName);
                    $("#itemId").val(dataId);
                }

                $("#userManualSearchModal, #itemManualSearchModal").modal('hide');
                
            });
        });
    </script>
<?php endbuild()?>
<?php loadTo()?>