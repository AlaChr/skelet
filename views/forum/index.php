

<?php include (ROOT.'/views/layouts/header.php');?>

   
<?php if (isset($_SESSION['iduser'])): ?>
    <?php echo 'Рады вас приветствовать'.$_SESSION['iduser'];?>
<?php endif; ?>
<form id="forumtheme" action="forumtheme" method="POST">
   
    
        <?php foreach ($forumtheme as $item):?>
        
        <p></p>
        <a href="forumcontent/<?php echo $item['id']?>" target="_self" title="Текст подсказки для ссылки"><?php echo ($item['name_theme']); ?></a>
        <p><?php echo ($item['data_create']);?></p>
        <p><?php echo ($item['nameuser']);?></p>
        <p><?php echo ($item['count']);?></p>
    <?php endforeach;?>
    
    
</form>
<form id="registration" action="forumcreatetheme" method="POST">
    <a>Наименование новой темы</a><input type="text" name ="theme" required>
    <input type="submit" title="Отправка">
</form>




<?php include (ROOT.'/views/layouts/footer.php');?>
