

<?php include (ROOT.'/views/layouts/header.php');?>


<?php if (isset($_SESSION['iduser'])): ?>
    <?php echo 'Рады вас приветствовать'.$_SESSION['iduser'];?>
<?php endif; ?>
<form id="themecontent" action="forumcontent" method="POST">
   
    
        <?php foreach ($forumcontent as $item):?>
        
        <p></p>
        
        <p><?php echo ($item['data_create']);?></p>
        <p><?php echo ($item['content']);?></p>
        
    <?php endforeach;?>
    
    
</form>
<form id="savecontent" action="../forumcreatecontent" method="POST">
    <a>Наименование нового комментария</a><input type="text" name ="content" required>
    <input type="submit" title="Отправка">
</form>




<?php include (ROOT.'/views/layouts/footer.php');?>
