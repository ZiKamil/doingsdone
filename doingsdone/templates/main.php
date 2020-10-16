
<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="GET" autocomplete="off">
        <input class="search-form__input" type="text" name="SearchByTasks" value="<?=getGetVal('SearchByTasks')?>" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="<?=$urlnavigationOfParam?>AllTask" class="tasks-switch__item <?= 'AllTask'===$currentparam ? 'tasks-switch__item--active' : ''?>">Все задачи</a>
            <a href="<?=$urlnavigationOfParam?>Agenda" class="tasks-switch__item <?= 'Agenda'===$currentparam ? 'tasks-switch__item--active' : ''?>">Повестка дня</a>
            <a href="<?=$urlnavigationOfParam?>Tomorrow" class="tasks-switch__item <?= 'Tomorrow'===$currentparam ? 'tasks-switch__item--active' : ''?>">Завтра</a>
            <a href="<?=$urlnavigationOfParam?>Overdue" class="tasks-switch__item <?= 'Overdue'===$currentparam ? 'tasks-switch__item--active' : ''?>">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks === 1): ?>checked <?php endif; ?> >
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php
            if(count($errors) != 0){
                foreach ($errors as $key => $value) {
                    echo "<h3><span style='color: #9A34F1'>".$key.": </span>".$value."</h3>";
                }
            }
        ?>

    	<?php foreach ($taskz as $key => $tazk): ?>
    		<?php if( !$tazk['Completed'] || ($show_complete_tasks === 1 && $tazk['Completed']) ): ?>
                <?php 
                $raznica =  isset($taskz[$key]['DateOfCompletion']) ? strtotime($taskz[$key]['DateOfCompletion']) - time() : null ;
                if( empty($_GET['ParamSelect']) || ($_GET['ParamSelect'] === "AllTask")  || 
                    (
                        isset($taskz[$key]['DateOfCompletion']) && 
                        (
                            ($_GET['ParamSelect'] === "Overdue" &&  $raznica <= -86400 ) ||
                            ($_GET['ParamSelect'] === "Tomorrow" && $raznica  >= 0 && $raznica  <= 86400) ||
                            ($_GET['ParamSelect'] === "Agenda" && $raznica  >= -86400 && $raznica  <= 0)
                        )
                    )
                    ): ?>
               
                <tr class="tasks__item task <?php if($tazk['Completed'])echo('task--completed') ?> <?php if( isset($taskz[$key]['DateOfCompletion']) && $raznica <= -86400)echo('task--important') ?>">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <form action="" id="form<?=$taskz[$key]['ID']?>" method="post">
                                <a onclick="document.getElementById('form<?=$taskz[$key]['ID']?>').submit(); return false;" style='color: #000 !important;text-decoration: none' href=""> 
                                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" <?php if($tazk['Completed'])echo('checked') ?>>
                                    <span class="checkbox__text"><?=htmlspecialchars($tazk['Name']) ?></span> </a>
                       
                                <input type="hidden" name="task_id" value="<?=$taskz[$key]['ID']?>">
                                <input type="hidden" name="chk" value="<?=$taskz[$key]['Completed']?>">
                            </form>
                        </label>
                    </td>
                    <?= isset($tazk['File']) ? '<td class="task__file"> <a class="download-link" href="'.$tazk['File'].'">'.getNameFileOfURl($tazk['File']).'</a> </td>' : ""?>
                    <?='<td class="task__date">'.$tazk['DateOfCompletion'].'</td>'?>
                </tr>
                 <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</main>
