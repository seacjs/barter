<?php
namespace app\models;
use karpoff\icrop\CropImageUploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\bootstrap\ActiveField;
use yii\bootstrap\ActiveForm;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use Imagine\Image\Box;
use yii\web\View;

/**
 * This is the model class for table "{{%file_storage_item}}".
 *
 * @property integer $id
 * @property string $component
 * @property string $base_url
 * @property string $path
 * @property string $title
 * @property string $image_category
 * @property string $alt
 * @property string extension
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $sort
 * @property string $upload_ip
 * @property integer $created_at
 * @property integer $component_id
 */
class File extends ActiveRecord
{

    public $files;
    public $uploadedFiles = [];

    public $multiple = false;

    public $imagesPath = 'uploads/images/';
    public $imagesThumbnailsPath = 'uploads/thumbnails/';
    public $imagesOriginPath = 'uploads/origin/';
    public $imagesCropPath = 'uploads/crop/';


    /* image parameters */
    public $imageQuality = 80;
    public $imageThumbnailQuality = 50;
    public $imageOriginQuality = 100;
    public $imageThumbnailWidth = 800;
    public $imageThumbnailHeight = 800;

    const IMAGE_CATEGORY_MAIN = 0;
    const IMAGE_CATEGORY_CONTENT = 1;

    public $crop;
    public $photo_crop;
    public $photo_cropped;

    const IMAGE_NOT_FOUND_PATH = 'images/image_not_found.jpg';
    const IMAGE_NOT_FOUND_THUMBNAIL_PATH = 'images/image_not_found_thumbnail.jpg';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => CropImageUploadBehavior::className(),
                'attribute' => 'files',
                'scenarios' => ['crutch'],
                'path' => '@webroot/upload/images/crop',
                'url' => '@web/upload/images/crop',
                'ratio' => 1,
                'crop_field' => 'photo_crop',
                'cropped_field' => 'photo_cropped'
            ],
        ];
    }

    public $upload;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['files','upload'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif', 'maxFiles' => 40, 'maxSize' => 1024*1024*10000],
//            [['component', 'name'], 'required'],
            [['size','created_at','component_id','sort','image_category'], 'integer'],
            [['component', 'name', 'type', 'title', 'alt'], 'string', 'max' => 255],
            [['path', 'base_url'], 'string', 'max' => 1024],
            [['type'], 'string', 'max' => 45],
            [['upload_ip','extension'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'files' => Yii::t('app', 'Files'),
            'component' => Yii::t('app', 'Component'),
            'component_id' => Yii::t('app', 'Component ID'),
            'base_url' => Yii::t('app', 'Base Url'),
            'title' => Yii::t('app', 'Base Name'),
            'alt' => Yii::t('app', 'Base Name'),
            'image_category' => Yii::t('app', 'Image Category'),
            'path' => Yii::t('app', 'Path'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'name' => Yii::t('app', 'Name'),
            'sort' => Yii::t('app', 'Sort'),
            'extension' => Yii::t('app', 'Extension'),
            'upload_ip' => Yii::t('app', 'Upload Ip'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function uploadssss()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    public function upload($model = false, $inputName = false)
    {

        $uploadedFiles = [];
        if($inputName === false) {
             $this->files = UploadedFile::getInstances($this, 'files');
        } else {
            $this->files = UploadedFile::getInstancesByName($inputName);
        }

        if($this->validate()) {

            foreach ($this->files as $file) {

                $fileModel = new File();

                $fileModel->name = ''.md5(time().microtime());
                $fileModel->title = str_replace(['.',$file->extension],'',$file->name);
                $fileModel->alt = $fileModel->title;
                $fileModel->path = $this->imagesPath;
                $fileModel->extension = $file->extension;
                $fileModel->type = $file->type;
                $fileModel->size = $file->size;
                $fileModel->upload_ip = Yii::$app->request->userIP;

                // todo:: сделать проверку, вдруг файл там не загрузился или что то пошло не так...
                $fileModel->save();
                $file->saveAs($this->imagesPath . $fileModel->name . '.' . $file->extension);

                /* here Out of Memory */
//                $file->saveAs($this->imagesThumbnailsPath . $fileModel->name . '.' . $file->extension);

                /* todo: вынести размеры в конфиг; не говнокодить!!! */
                Image::thumbnail('@webroot/'.$this->imagesPath . $fileModel->name . '.' . $file->extension, $this->imageThumbnailWidth, $this->imageThumbnailHeight)
                    ->save(Yii::getAlias('@webroot/'.$this->imagesThumbnailsPath . $fileModel->name . '.' . $file->extension), ['quality' => $this->imageThumbnailQuality]);


                $post = Yii::$app->request->post();

                if(isset($post['File']['files'][0])) {
                    $path = Yii::getAlias('@webroot/'.$this->imagesPath . $fileModel->name . '.' . $file->extension);
                    $image = Image::getImagine()->open($path);

                    $path = Yii::getAlias('@webroot/'.$this->imagesCropPath . $fileModel->name . '.' . $file->extension);
                    $crop = explode('-', $post['File']['files'][0]);
                    $size = $image->getSize();
                    if(count($crop) > 1) {
                        foreach ($crop as $ind => $cr) {
                            $crop[$ind] = round($crop[$ind] * ($ind % 2 == 0 ? $size->getWidth() : $size->getHeight()) / 100);
                        }
                        $image->crop(
                            new Point($crop[0], $crop[1]),
                            new Box($crop[2] - $crop[0], $crop[3] - $crop[1])
                        )->save($path);
                    }
                }


                $this->uploadedFiles[] = $fileModel;

            }


            if($model) {
                /* todo: attach new files and no delete old */
                $this->refreshModel($model);
//                $this->attachToModel($model);
            }

            return $this->uploadedFiles;
        } else {

            // todo:: организовать вывод ошибок...
            return false;
        }
    }

    /*
     * Remove deleted files and attach new
     * */
    public function refreshModel($model) {
        if(count($this->uploadedFiles) > 0 && !$this->multiple) {
            $this->detachAllFromModel($model);
        }
        $this->attachToModel($model);
    }

    public function attachToModel($model) {
        foreach($this->uploadedFiles as $uploadedFile) {
            $uploadedFile->component = $model->getTableSchema()->name;
            $uploadedFile->component_id = $model->id;
            $uploadedFile->save();
        }
    }
    public function detachAllFromModel($model, $delete = true) {

        foreach($model->mainFiles as $file) {

            if($delete) {
                $file->remove();
            } else {
                $file->component = NULL;
                $file->component_id = NULL;
                $file->save();
            }
        }

    }
    public function detach($delete = true) {

        if($delete) {
            $this->remove();
        } else {
            $this->component = NULL;
            $this->component_id = NULL;
            $this->save();
        }
    }

    /*
     * @files - array or model
     * */
    public static function initialPreview($files) {

        if(!is_array($files)) {
            $files = $files->mainFiles;
        }

        $result = [];
        foreach($files as $file) {
            $result[] = $file->getImage();
        }
        return $result;

    }

    /**
     * For kartik image Upload widget
     * @files - array or model
     * */
    public static function initialPreviewConfig($files) {

        if(!is_array($files)) {
            $files = $files->files;
        }
        $result = [];
        foreach($files as $file) {
            $result[] = [
                'caption' => $file->title,
                'url'=> '/'.Yii::$app->controller->id.'/file-delete/' . $file->id,
            ];
        }
        return $result;
    }

    /**
     * Options for kartik file upload image widget
     */
    public static function initialOptions($fileModel, $model) {
        return [
            'options' => [
                'multiple' => $fileModel->multiple,
                'accept' => 'image/*',
                'id' => 'file-input-widget',
            ],
            'pluginOptions' => [
                //            ['fa', 'fas', 'gly', 'explorer', 'explorer-fa', 'explorer-fas'];
//                'theme' => 'explorer-fas',
                'resizeImage' => true,
                'maxImageWidth' => 5800,
                'maxImageHeight' => 5800,
                'resizePreference'=>'width',
                //'image'=>['width'=>'190px','height'=>'190px'],

                'uploadAsync' => false,
                'maxFileSize' => 70000000,
                'maxFileCount' => 20,
                'initialPreview' => self::initialPreview($model),
                'initialPreviewAsData'=> true,
                'initialPreviewConfig' => self::initialPreviewConfig($model),
                'showUpload' => false,

                'uploadClass' => 'btn btn-info',
//                'uploadUrl' => '/admin/file/upload',
                'uploadUrl' => '/'.Yii::$app->controller->id.'/file-upload',
                'uploadExtraData' => [
                    'multiple' => $fileModel->multiple,
                    'model' => $model->className(),
                    'component' => $model->getTableSchema()->name,
                    'component_id' => $model->id
                ],
                'overwriteInitial' => !$fileModel->multiple,
                'showRemove' => false,
                'showClose' => false,
                'layoutTemplates' => [
                    'main1' => (new View())->renderAjax('@app/views/photoblock/_template'),
                    'preview' => (new View())->renderAjax('@app/views/photoblock/_preview'),
                    'btnDefault' => (new View())->renderAjax('@app/views/photoblock/_btnDefault'),
                    'btnBrowse' => (new View())->renderAjax('@app/views/photoblock/_btnBrowse'),
                    'footer' => (new View())->renderAjax('@app/views/photoblock/_footer'),
                    'caption' => (new View())->renderAjax('@app/views/photoblock/_caption'),
                ],
            ],
            'pluginEvents' => [
                'fileimagesresized' => new \yii\web\JsExpression('function(event){$("#file-input-widget").fileinput("upload")}'),

//                'change' => new \yii\web\JsExpression('function(event,params){console.log("change");}'),
//                'filebatchselected' => new \yii\web\JsExpression('function(event,params){console.log("filebatchselected");}'),
//                'fileimageloaded' => new \yii\web\JsExpression('function(event,previewId){console.log("fileimageloaded");}'),
//                'fileimagesloaded' => new \yii\web\JsExpression('function(event){console.log("fileimagesloaded");}'),
//                'filepreupload' => new \yii\web\JsExpression('function(event){console.log("filepreupload");}'),
//                'fileselect' => new \yii\web\JsExpression('function(event,params){console.log("fileselect");}'),
                'filesorted' => new \yii\web\JsExpression('function(event, params){$.post("/'.Yii::$app->controller->id.'/file-sort/'.$model->id.'", {sort: params, model: "'.$model->getTableSchema()->name.'"},function(data){console.log(data);})}'),
//                'fileloaded' => new \yii\web\JsExpression('function(event, file, previewId, index, reader){function funcSend(){$("#file-input-widget").fileinput("upload")}setTimeout(funcSend, 100);}')
//                'fileimagesloaded' => new \yii\web\JsExpression('function(event){$("#file-input-widget").fileinput("upload")}')
            ],
        ];
    }

    /*
     * todo: переработать следующие методы
     * */
    public function getCrop() {
        return '/' .$this->imagesCropPath . $this->name . '.' . $this->extension;
    }
    public function getImage() {
        return '/' .$this->imagesPath . $this->name . '.' . $this->extension;
    }
    public function getThumbnail() {
        return '/' .$this->imagesThumbnailsPath . $this->name . '.' . $this->extension;
    }
    /* todo: сделать сохранение оригинальной картинки */
    public function getOrigin() {
        return '/' .$this->imagesThumbnailsPath . $this->name . '.' . $this->extension;
    }

    public function remove() {
        unlink(Yii::getAlias('@webroot') . '/' .$this->imagesPath . $this->name . '.' . $this->extension);
        unlink(Yii::getAlias('@webroot') . '/' .$this->imagesThumbnailsPath . $this->name . '.' . $this->extension);
        $component_id = $this->component_id;
        $component = $this->component;
        $sortDeleted = $this->sort;
        $this->delete();
        $this->sortAfterDelete($sortDeleted, $component, $component_id);
    }

    public function sortAfterDelete($sortDeleted, $component, $component_id) {
        /* todo: переделать сортировку после удаления и вобоще сортировку */
        $files = self::find()->where([
            '>','sort',$sortDeleted
        ])->andWhere([
            'component_id' => $component_id
        ])->andWhere([
            'component' => $component
        ])->all();

        foreach($files as $file) {
            $file->sort = $file->sort - 1;
            $file->save();
        }

    }

    /* todo: if i can - delete this method */
    public function getKcfOptions() {
//        Yii::$app->view->params['kcfOptions']
        return array_merge(\iutbay\yii2kcfinder\KCFinder::$kcfDefaultOptions, [
                'disabled' => false,
                'denyZipDownload' => true,
                'denyUpdateCheck' => true,
                'denyExtensionRename' => true,
                'theme' => 'default',
                'uploadURL' => Yii::getAlias('@web').'/upload',
                'access' => [
                    'files' => [
                        'upload' => true,
                        'delete' => true,
                        'copy' => true,
                        'move' => true,
                        'rename' => true,
                    ],
                    'dirs' => [
                        'create' => true,
                        'delete' => true,
                        'rename' => true,
                    ],
                ],
                'types' => [
                    'images' => [
                        'type' => '',
                    ],
                ],
                'thumbsDir' => '.thumbs',
                'thumbWidth' => 100,
                'thumbHeight' => 100,
            ]
        );
    }




}