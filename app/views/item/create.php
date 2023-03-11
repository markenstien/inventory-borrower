<?php build('content') ?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Item</h4>
            <?php echo wLinkDefault(_route('item:index'), 'back to list')?>
            <?php Flash::show()?>
        </div>

        <div class="card-body">
            <?php echo $item_form->getForm()?>
        </div>
    </div>
<?php endbuild()?>
<script>
    $(document).ready(function() {
        $(body).on('submit', function() {
            alert('submit?');
        });
    });
</script>
<?php loadTo()?>