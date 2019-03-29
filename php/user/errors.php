<?php  if (count($errors) > 0) : ?>
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
<?php  endif ?>


<?php  if (isset($_SESSION['success'])) : ?>
  <div class="success">
      <p><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
  </div>
<?php  endif ?>