<div class="main-header__side">
    <a class="main-header__side-item button button--plus open-modal" href="?addTask<?= isset($_GET['project']) ? "&project=".$_GET['project'] : ""?>">Добавить задачу</a>

    <div class="main-header__side-item user-menu">
        <div class="user-menu__data">
            <p><?= $user_name?></p>

            <a href="/?SignOut">Выйти</a>
        </div>
    </div>
</div>
