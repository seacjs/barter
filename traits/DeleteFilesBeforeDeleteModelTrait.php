<?php

namespace app\traits;

use app\models\File;

trait DeleteFilesBeforeDeleteModelTrait {
    public function beforeDelete()
    {
        $files = $this->getFiles()->all();
        foreach($files as $file) {

            $file->remove();
        }
        return parent::beforeDelete();
    }
}