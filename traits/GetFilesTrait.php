<?php

namespace app\traits;

use app\models\File;

trait GetFilesTrait {
    public function getFiles() {
        return $this->hasMany(File::class, ['component_id' => 'id'])->andWhere([
            'component' => $this->tableName(),
        ])->orderBy(['sort' => SORT_ASC]);
    }
    public function getMainFiles() {
        return $this->hasMany(File::class, ['component_id' => 'id'])->andWhere([
            'component' => $this->tableName(),
        ])->andWhere([
            'image_category' => File::IMAGE_CATEGORY_MAIN
        ])->orderBy(['sort' => SORT_ASC]);
    }
    public function getContentFiles() {
        return $this->hasMany(File::class, ['component_id' => 'id'])->andWhere([
            'component' => $this->tableName(),
        ])->andWhere([
            'image_category' => File::IMAGE_CATEGORY_CONTENT
        ])->orderBy(['sort' => SORT_ASC]);
    }
}