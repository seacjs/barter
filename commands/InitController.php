<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

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
        $this->initUsersData();
        $this->initRbacData();

        echo "First data initialised.\n";

        return ExitCode::OK;
    }

    /**
     * Init users data
     */
    public function initUsersData()
    {

        echo "User data initialised.\n";
    }
    /**
     * Init RBAC system
     */
    public function initRbacData()
    {
        $auth = Yii::$app->authManager;

        /* now default roles */
        /* in next version will be updating */

        /*
         * todo: Add roles
         * admin, developer, superAdmin, user
         * */

        //creating post
        $createProduct = $auth->createPermission('createProduct');
        $createProduct->description = 'Create Product';
        $auth->add($createProduct);

        //deleting post
        $deleteProduct = $auth->createPermission('deleteProduct');
        $deleteProduct->description = 'Delete Product';
        $auth->add($deleteProduct);

        //update post
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

        //create role 'admin' and add permissions
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $user);
        $auth->addChild($admin, $deleteUser);
    }
}
