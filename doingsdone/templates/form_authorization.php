
  <section class="content__side">
    <p class="content__side-info">Если у вас ещё нет аккаунта, зарегистрируетесь на сайте</p>
    <a class="button button--transparent content__side-button" href="?Register">Зарегистрироваться</a>
  </section>

  <main class="content__main">
    <h2 class="content__main-heading">Вход на сайт</h2>

    <form class="form" action="" method="post" autocomplete="off">


    <div class="form__row">
      <label class="form__label" for="email">E-mail <sup>*</sup></label>
      <input class="form__input <?= array_key_exists('email', $errors)? "form__input--error":"" ?>" type="text" name="email" id="email" value="<?=getPostVal('email')?>" placeholder="Введите e-mail">
      <?= array_key_exists('email', $errors)? "<p class='form__message'>".$errors['email']."</p>":"" ?>
    </div>


    <div class="form__row">
      <label class="form__label" for="password">Пароль <sup>*</sup></label>
      <input class="form__input <?= array_key_exists('password', $errors)? "form__input--error":"" ?>" type="password" name="password" id="password" value="" placeholder="Введите пароль">
      <?= array_key_exists('password', $errors)? "<p class='form__message'>".$errors['password']."</p>":"" ?>
    </div>

      <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Войти">
      </div>
    </form>

  </main>
