

<?php include (ROOT.'/views/layouts/header.php');?>

<form id="registration" action="registration" method="POST" enctype=multipart/form-data>
    <a>Логин</a><input type="text" name ="user" required>
    <a>Емайл</a><input type="text" name ="email" required>
    <a>Пароль</a><input type="text" name ="password" required>
    <a>Выбор фото</a><input type="file" name ="uploadfile">
    <input type="submit" title="Отправка">
</form>




<?php include (ROOT.'/views/layouts/footer.php');?>
