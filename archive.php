<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board">
            <div class="post-head">
                <h3><?php $this->archiveTitle(array(
            'category'  =>  _t('“%s”'),
            'search'    =>  _t('“%s”的搜索结果'),
            'tag'       =>  _t('含标签“%s”的文章'),
            'author'    =>  _t('“%s”发布的文章')
        ), '', ''); ?></h3>
<?php if ($this->is('category')) : ?><p><?php echo $this->getDescription(); ?></p><?php endif; ?>
            </div>
<?php if ($this->have()): ?>
<?php while($this->next()): ?>
            <div class="post-item">
                <time class="date"><?php $this->date(); ?></time>
                <h3 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
            </div>
<?php endwhile; ?>
<?php else: ?>
            <p>没有找到结果 (QWQ)</p>
<?php endif; ?>
        </section>
        <?php $this->pageNav('', ''); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>