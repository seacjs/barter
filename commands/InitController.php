<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Category;
use app\models\CategoryGoods;
use app\models\CategoryService;
use app\models\City;
use app\models\Region;
use app\models\SystemMoney;
use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\helpers\VarDumper;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class InitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    /**
     * This command initialise first data
     */
    public function actionData()
    {
        $this->initRbacData();
        $this->initCityData();
        $this->initUsersData();
        $this->initCategoryData();
        $this->initMoney();

        $this->stdout("First data initialised. Done.\n", Console::FG_GREEN);

        return ExitCode::OK;
    }

    /**
     * Add system money row
     */
    public function initMoney()
    {
        $systemMoney = new SystemMoney();
        $systemMoney->value = 0;
        $systemMoney->total = 0;
        $systemMoney->save();
    }

    /**
     * Init users data
     */
    public function initUsersData()
    {
        if(YII_ENV_DEV) {

            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $adminRole = $auth->getRole('admin');
            $superAdminRole = $auth->getRole('superAdmin');

            $user = new User();
            $user->username = 'user';
            $user->setPassword('111');
            $user->email = 'user@barter.dev';
            $user->save();
            $user->profile->city_id = 1;
            $user->profile->save();

            $auth->assign($userRole, $user->id);

            $admin = new User();
            $admin->username = 'admin';
            $admin->setPassword('111');
            $admin->email = 'admin@barter.dev';
            $admin->save();
            $admin->profile->city_id = 1;
            $admin->profile->save();

            $auth->assign($adminRole, $admin->id);

            $superAdmin = new User();
            $superAdmin->username = 'superAdmin';
            $superAdmin->setPassword('111');
            $superAdmin->email = 'superAdmin@barter.dev';
            $superAdmin->save();
            $superAdmin->profile->city_id = 1;
            $superAdmin->profile->save();

            $auth->assign($superAdminRole, $superAdmin->id);

            $this->stdout("User data initialised. Done.\n", Console::FG_GREEN);
        }
    }
    /**
     * Init users data
     */
    public function initCityData()
    {
        if(YII_ENV_DEV) {

            $regionMoscow = new Region();
            $regionMoscow->name = 'Московская область';
            $regionMoscow->slug = 'moscow-oblast';
            $regionMoscow->save();

            $regionLen = new Region();
            $regionLen->name = 'Ленинградская область';
            $regionLen->slug = 'len-oblast';
            $regionLen->save();

            $city = new City();
            $city->name = 'Москва';
            $city->slug = 'msk';
            $city->region_id = $regionMoscow->id;
            $city->save();

            $city2 = new City();
            $city2->name = 'Санкт-Петербург';
            $city2->slug = 'spb';
            $city2->region_id = $regionLen->id;
            $city2->save();

            $this->stdout("City and region data initialised. Done.\n", Console::FG_GREEN);
        }
    }
    /**
     * Init RBAC system
     */
    public function initRbacData()
    {
        $auth = Yii::$app->authManager;

        /* now default roles */
        /* in next version will be updating */

        //creating
        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Create Product';
        $auth->add($createProduct);

        //deleting
        $deleteProduct = $auth->createPermission('deleteProduct');
        $deleteProduct->description = 'Delete Product';
        $auth->add($deleteProduct);

        //update
        $updateProduct = $auth->createPermission('updateProduct');
        $updateProduct->description = 'Update Product';
        $auth->add($updateProduct);

        //delete user
        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Delete User';
        $auth->add($deleteUser);

        //create role 'user' and add permissions
        $user = $auth->createRole('user');
        $user->description = 'User';
        $auth->add($user);
        $auth->addChild($user, $createProduct);
        $auth->addChild($user, $deleteProduct);
        $auth->addChild($user, $updateProduct);

        //create role 'manager' and add permissions
        $manager = $auth->createRole('manager');
        $manager->description = 'Manager';
        $auth->add($manager);
        $auth->addChild($manager, $user);

        //create role 'admin' and add permissions
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $deleteUser);

        //create role 'super admin' and add permissions
        $superAdmin = $auth->createRole('superAdmin');
        $superAdmin->description = 'Super Administrator';
        $auth->add($superAdmin);
        $auth->addChild($superAdmin, $admin);
        $auth->addChild($superAdmin, $deleteUser);

        $this->stdout("RBAC data initialised.\n", Console::FG_GREEN);
    }

    public function initCategoryData() {
        foreach([
                ['name' => 'Авто', 'slug' => 'auto'],
                ['name' => 'Музыкальные инструменты', 'slug' => 'music'],
                ['name' => 'Товары для дома', 'slug' => 'home'],
            ] as $item) {
            $cat = new CategoryGoods();
            $cat->name = $item['name'];
            $cat->slug = $item['slug'];
            $cat->createNode();
        }

        foreach([
                    ['name' => 'Уборка помещений', 'slug' => 'clean'],
                    ['name' => 'Разработка сайтов', 'slug' => 'web-dev'],
                    ['name' => 'Массаж', 'slug' => 'massage'],
                ] as $item) {
            $cat = new CategoryService();
            $cat->name = $item['name'];
            $cat->slug = $item['slug'];
            $cat->createNode();
        }
    }
}
