<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board error-page">
			<div class="post-title">
                <h2>404</h2>
				<p>你正在寻找的文章已经不见了，不妨看看其他文章？</p>
            </div>
			<ul class="archives-list">
<?php

function theme_random_posts(){
	$defaults = array(
		'xformat' => '<li class="archive-post"><a class="archive-post-title" href="{permalink}">{title}</a><span class="date">{date}</span></li>'
	);

	$db = Typecho_Db::get();
	$sql = $db -> select() -> from('table.contents')
		-> where('status = ?','publish')
		-> where('type = ?', 'post')
		-> limit(6)
		-> order('RAND()');
	$result = $db->fetchAll($sql);

	foreach($result as $value){
		$value = Typecho_Widget::widget('Widget_Abstract_Contents') -> filter($value);
		echo str_replace(array('{permalink}', '{title}', '{date}'), array($value['permalink'], $value['title'], date("Y-m-d", $value['created'])), $defaults['xformat']);
	}
}

theme_random_posts();

?>
			</ul>
        </section>
    </div>
</main>

<?php $this->need('footer.php'); ?>