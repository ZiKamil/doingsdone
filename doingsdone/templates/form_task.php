<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="" method="POST" autocomplete="off" enctype="multipart/form-data">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?= array_key_exists('name', $errors)? "form__input--error":"" ?>" type="text" name="name" id="name" value="<?=getPostVal('name')?>" placeholder="Введите название"  maxlength="255">

            <?= array_key_exists('name', $errors)? "<p class='form__message'>".$errors['name']."</p>":"" ?>
          </div>

          <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>

            <select class="form__input form__input--select <?= array_key_exists('project', $errors)? "form__input--error":"" ?>" name="project" id="project">
                <option value="" selected disabled hidden>Выберите проект</option>
                <?php foreach ($projectz as $key => $projez): ?>
                    <option  <?= isset($_POST['project']) && htmlspecialchars($projez['ID']) === $_POST['project'] ?"selected":"" ?> value="<?=htmlspecialchars($projez['ID']); ?>"><?=htmlspecialchars($projez['Name']); ?></option>
                <?php endforeach; ?>
            </select>
            <?= array_key_exists('project', $errors)? "<p class='form__message'>".$errors['project']."</p>":"" ?>
          </div>

          <div class="form__row">
            <label class="form__label " for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?= array_key_exists('date', $errors)? "form__input--error":"" ?>" type="text" name="date" id="date" value="<?=getPostVal('date')?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <?= array_key_exists('date', $errors)? "<p class='form__message'>".$errors['date']."</p>":"" ?>
          </div>




          <div class="form__row">
            <label class="form__label" for="file">Файл</label>

            <div class="form__input-file">
              <input  class="visually-hidden" type="file" name="file" id="file" value="<?=$_FILES['file']?>">
              <label class="button button--transparent <?= array_key_exists('file', $errors)? "form__input--error":"" ?>" for="file">
                <span>Выберите файл</span>
              </label>
            </div>
            <?= array_key_exists('file', $errors)? "<p. class='form__message'>".$errors['file']."</p>":"" ?>
          </div>



          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
</main>
