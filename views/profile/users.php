<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 22.06.2018
 * Time: 13:39
 */

?>



<?php foreach($users as $user):?>

    <div><?=\yii\bootstrap\Html::a($user->username, ['/profile/view/'.$user->id])?></div>

<?php endforeach ?>
