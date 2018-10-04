<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 13.07.2018
 * Time: 8:48
 */

//'exception' => $exception,
//'statusCode' => $statusCode,
//'name' => $name,
//'message' => $message

?>

<div class="admin-default-index">
    <h1><?= $name . ' ' .$statusCode ?></h1>
    <p>
        <?= $message ?>
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
