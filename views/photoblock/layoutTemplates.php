<?php

use yii\web\View;

return [
    'main1' => (new View())->renderAjax('@app/views/photoblock/_template'),
    'preview' => (new View())->renderAjax('@app/views/photoblock/_preview'),
    'btnDefault' => (new View())->renderAjax('@app/views/photoblock/_btnDefault'),
    'btnBrowse' => (new View())->renderAjax('@app/views/photoblock/_btnBrowse'),
    'footer' => (new View())->renderAjax('@app/views/photoblock/_footer'),
];