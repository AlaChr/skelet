

<?php include (ROOT.'/views/layouts/header.php');?>

   
<?php if (isset($_SESSION['iduser'])): ?>
    <?php echo 'Рады вас приветствовать'.$_SESSION['iduser'];?>
<?php endif; ?>
<form id="forumtheme" action="forumtheme" method="POST">
   
        <?php $content = $forumtheme[0];?>
        <?php foreach ($content as $item):?>
        
        <p></p>
        <a href="<?php echo '/forumcontent/'.$item['id'].'/p1' ?>" target="_self" title="Текст подсказки для ссылки"><?php echo ($item['name_theme']); ?></a>
        <p><?php echo ($item['data_create']);?></p>
        <p><?php echo ($item['nameuser']);?></p>
        <p><?php echo ($item['count']);?></p>
    <?php endforeach;?>
<?php $object = new Pagination($forumtheme[1],$forumtheme[2],$forumtheme[3],$forumtheme[4]); ?> 
    
</form>
<form id="registration" action="/forumcreatetheme" method="POST">
    <a>Наименование новой темы</a><input type="text" name ="theme" required>
    <input type="submit" title="Отправка">
</form>

<script src="jquery/menu.js"></script>


<?php include (ROOT.'/views/layouts/footer.php');?>
