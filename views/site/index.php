<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <p><strong>Зарегистрируйтесь или авторизуйтесь на портале и оставайтесь в курсе новостей Ваших друзей или партнеров, где бы Вы ни находились.</strong></p>
        <div class="row">
            <div id="tg-content" class="tg-content">
                <div class="tg-loginsignup">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="tg-logingarea">
                            <h2>Авторизация</h2>

                            <?=$this->render('/forms/authForm', [
                                'authFormModel' => $authFormModel,
                            ])?>

                        </div>
                        <div class="tg-texbox">
                            <p><strong>Зарегистрируйтесь или авторизуйтесь на портале и оставайтесь в курсе новостей Ваших друзей или партнеров, где бы Вы ни находились.</strong></p>
                            <p>Quis nostrud exercitation ullamcoaris nisiuate aliquip ex ea commodo consequat aute irure dolor atem reprehenderit in esse.</p>
                            <ul>
                                <li>Proident sunt in culpa qui officia</li>
                                <li>Deserunt mollit anim idestorum</li>
                                <li>Sedutana perspiciatis</li>
                                <li>Aunde omnis iste natus voluptatem</li>
                                <li>Cullamcoaris nisiutia aliquip</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="tg-videobox">
                            <figure>
                                <img src="images/placeholder-02.jpg" alt="image description">
                                <a class="tg-btnplayvideo" href="javascript:void(0);"><i class="icon-play3"></i></a>
                            </figure>
                        </div>
                        <div class="tg-title">
                            <h2>Регистрация</h2>
                        </div>
                        <div class="tg-haslayout">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                    <?php if($signUpFormModel->complited):?>
                                        <p>Вы зарегистрированы, на ваш email отправлено письмо для подтверждения регистрации.</p>
                                    <?php else: ?>
                                        <?= $this->render('/forms/signUpForm', [
                                            'signUpFormModel' => $signUpFormModel
                                        ]);?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>