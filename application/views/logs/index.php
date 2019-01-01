
<h1><?= $title?></h1>
<table id="logs" class="table table-striped table-bordered table-sm logs" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>User ID</th>
            <th>Code</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$logs === FALSE) : ?>
            <?php foreach($logs as $log) : ?>
                <tr>
                    <td>
                        <?php echo $log->date_time?>
                    </td>
                    <td>
                        <?php echo $log->user_id ?>
                    </td>
                    <td>
                        <?php echo $log->code ?>
                    </td>
                    <td>
                        <?php echo $log->message ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<script src="<?php echo base_url()?>assets/javascript/logs.js"></script>