<?php

namespace app\traits;

use app\models\File;

trait GetFileTrait {
    public function getFile() {
        return $this->hasOne(File::class, ['component_id' => 'id'])->andWhere([
            'component' => $this->tableName(),
        ])->orderBy(['sort' => SORT_ASC]);
    }
}