<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Borrows</h4>
            <?php echo wLinkDefault(_route('borrow:create'), 'Borrow')?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table dataTable">
                    <thead>
                        <th>#</th>
                        <th>Borrower</th>
                        <th>Item</th>
                        <th>Borrowed Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php foreach($borrows as $key => $row) :?>
                            <tr>
                                <td><?php echo ++$key?></td>
                                <td><?php echo $row->borrower_name?></td>
                                <td><?php echo $row->item_name?></td>
                                <td><?php echo $row->borrow_date?></td>
                                <td><?php echo $row->status?></td>
                                <td><?php echo wLinkDefault(_route('borrow:show', $row->id) ,'Show Session')?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endbuild()?>
<?php loadTo()?>