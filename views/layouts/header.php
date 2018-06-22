<header id="tg-header" class="tg-header tg-haslayout">

    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo"><a href="/"><img src="/images/logo.png" alt="company logo here"></a></strong>


                    <nav id="tg-nav" class="tg-nav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                <span class="sr-only">Переключить навигацию</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                            <ul>
                                <li class="menu-item">
                                    <a href="/site/about">О проекте</a>
                                </li>
<!--                                <li class="menu-item">-->
<!--                                    <a href="/">Желания</a>-->
<!--                                </li>-->
                                <?php if(!Yii::$app->user->isGuest): ?>
                                    <li class="menu-item">
                                        <a href="/profile/update">Личный кабинет</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="/profile/users">Другие пользователи</a>
                                    </li>
                                <?php endif ?>


<!--                                <li class="menu-item">-->
<!--                                    <a href="/site/about">Расчетный отдел</a>-->
<!--                                </li>-->

<!--                                <li class="menu-item">-->
<!--                                    <a href="/news">Новости проекта</a>-->
<!--                                </li>-->

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>