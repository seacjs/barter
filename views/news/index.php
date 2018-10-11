<?php
/**
 * Created by PhpStorm.
 * User: seacjs
 * Date: 10.10.2018
 * Time: 23:53
 */

?>
 Новости <br>

<?php foreach($news as $item):?>

    <li><a href="/news/view/<?=$item->id?>"><?=$item->name?></a></li>

<?php endforeach ?>