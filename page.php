<?php

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board">
            <div class="post-title">
                <h2><?php $this->title() ?></h2>
<?php if($this->authorId == $this->user->uid): ?>
                <div class="post-meta">
                    <time class="date"><?php $this->date(); ?></time>
                    <span class="comments"><?php $this->commentsNum('%d 条评论'); ?></span>
                    <span class="edit"><a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid;?>" target="_blank">编辑</a></span>
                </div>
<?php endif; ?>
            </div>
            <article class="post-content">
                <?php $this->content(); ?>
            </article>
        </section>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>