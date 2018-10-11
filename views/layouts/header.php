<nav class="nav">
    <div class="nav__content">
        <img src="/images/Brand.png" alt="" / class="nav__brand">
        <ul class="nav__menu">
            <li class="nav__item"><a href="#" class="nav__link">О проекте</a></li>
            <li class="nav__item"><a href="/favorite" class="nav__link">Желания</a></li>
            <li class="nav__item"><a href="/profile/update" class="nav__link">Личный кабинет</a></li>
            <li class="nav__item"><a href="/profile/transactions" class="nav__link">Расчетный отдел</a></li>
            <li class="nav__item"><a href="/news" class="nav__link">Новости проекта</a></li>
        </ul>
        <div class="nav__search">
            <?php echo \app\widgets\ProductSearchWidget::widget()?>
        </div>
    </div>
</nav>

