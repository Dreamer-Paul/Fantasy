<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board head">
            <h3><?php $this->archiveTitle(array(
                'category'  =>  _t('<i class="fa fa-folder"></i>%s'),
                'search'    =>  _t('<i class="fa fa-search"></i>搜索结果：%s'),
                'tag'       =>  _t('<i class="fa fa-tags"></i>%s'),
                'author'    =>  _t('<i class="fa fa-user"></i>%s 的文章')
            ), '', ''); ?></h3>
        </section>
        <section class="board">
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