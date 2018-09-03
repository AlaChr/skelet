<!DOCTYPE html>

<html>
<div id="pagination">
<span>Страницы: </span>
<?php if ($active != 1): ?> 
<a href="<?php echo $url_page.'1'?>" title="Первая страница">&lt;&lt;&lt;</a>
<?php if ($active == 2): ?>
<a href="<?php echo $url_page.'1'?>" title="Предыдущая страница">&lt;</a>
<?php else: ?> <a href="<?php echo $url_page.($active - 1)?>" title="Предыдущая страница">&lt;</a>
<?php endif; ?>
<?php endif; ?>
<?php for ($i = $start; $i <= $end; $i++): ?>
<?php if ($i == $active): ?> 
<a><?php echo $i ?></a>
<?php else: ?>
<a href="<?php echo $url_page.$i ?>"><?php echo $i ?></a>
<?php endif; ?> 
<?php endfor; ?>
<?php if ($active != $count_pages):?> 
<a href="<?php echo $url_page.($active+1) ?>" title="Следующая страница">&gt;</a>
<a href="<?php echo $url_page.$count_pages ?>" title="Последняя страница">&gt;&gt;&gt;</a>
<?php endif; ?>
</div>
</html>

