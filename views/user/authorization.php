

<?php include (ROOT.'/views/layouts/header.php');?>

    <?php if (!isset($_SESSION['iduser'])): ?>
<form id="registration" action="authorization" method="POST">
    <a>Логин</a><input type="text" name ="user" required>
    <a>Пароль</a><input type="password" name ="password" required>
    <input type="submit" title="">
</form>
    <?php endif; ?>
    <?php if (isset($_SESSION['iduser'])): ?>
<form id="registration" action="unlog" method="POST">
    <input type="submit" title="Выход">
</form>
    <?php endif; ?>


<?php include (ROOT.'/views/layouts/footer.php');?>
