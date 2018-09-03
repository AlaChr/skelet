

<?php include (ROOT.'/views/layouts/header.php');?>


<?php if (isset($_SESSION['iduser'])): ?>
    <?php echo 'Рады вас приветствовать'.$_SESSION['iduser'];?>
<?php endif; ?>
<form id="themecontent" action="forumcontent" method="POST">
        
        <?php $theme = $forumcontent[0];?>
        <p><?php echo $theme[0]['name_theme']?></p>
        <p><?php echo $theme[0]['data_create']?></p>
         <p>--------------------------------------</p>
        <span></span>
    
        <?php $content = $forumcontent[1];?>
        <?php foreach ($content as $item):?>
        
        <p></p>
        
        <p><?php echo ($item['data_create']);?></p>
        <p><?php echo ($item['content']);?></p>
        <p><?php echo ($item['nameuser']);?></p>
        <p><img src="<?php echo $item['path']?>"></p>
        <p>--------------------------------------</p>
        
    <?php endforeach;?>
    
    <?php $object = new Pagination($forumcontent[2],$forumcontent[3],$forumcontent[4],$forumcontent[5]); ?> 
      
</form>
<form id="savecontent" action="<?php http://'$_SERVER['HTTP_HOST'] ?>/forumcreatecontent" method="POST">
    <a>Наименование нового комментария</a><input type="text" name ="content" required>
    <input type="submit" title="Отправка">
</form>

<script src="/jquery/menu.js"></script>


<?php include (ROOT.'/views/layouts/footer.php');?>
