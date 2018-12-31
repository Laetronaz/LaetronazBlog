
<h2><?= $title; ?></h2>
<table id="logs" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>User ID</th>
            <th>Code</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($logs as $log) : ?>
            <tr class="table-secondary">
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
    </tbody>
</table>
<script src="<?php echo base_url()?>assets/javascript/logs.js"></script>