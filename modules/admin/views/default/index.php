<div class="admin-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>

<div>

    <?php

        $query = (new \yii\db\Query())->from('test')->all();

    ?>
    <table class="table table-hover">
        <thead>
            <th>id</th>
            <th>time</th>
            <th>message</th>
        </thead>
        <tbody>
        <?php foreach($query as $item):?>
            <tr>
                <td><?=$item['id']?></td>
                <td><?=date('Y.m.d H:i:s',$item['created_at'])?></td>
                <td><?=$item['message']?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

</div>