<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
          <?php foreach ($projectz as $key => $projez): ?>

            <li class="main-navigation__list-item <?= $projez['Name'] === $currentproject ? "main-navigation__list-item--active":"" ?>">
                <a class="main-navigation__list-item-link" href="<?=$urlnavigationOfProject.htmlspecialchars($projez['Name'])?>"><?=htmlspecialchars($projez['Name']);?></a>
                <span class="main-navigation__list-item-count"> <?=$projez['Quantity']; ?> </span>
            </li>

            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="/index.php?addProject" target="project_add">Добавить проект</a>
</section>