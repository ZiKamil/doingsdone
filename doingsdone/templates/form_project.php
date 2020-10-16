<main class="content__main">
        <h2 class="content__main-heading">Добавление проекта</h2>

        <form class="form"  action="" method="post" autocomplete="off">
          <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?= array_key_exists('name', $errors)? "form__input--error":"" ?>" type="text" name="name" id="name" value="<?=getPostVal('name')?>" placeholder="Введите название"  maxlength="255">

            <?= array_key_exists('name', $errors)? "<p class='form__message'>".$errors['name']."</p>":"" ?>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>