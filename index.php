<?php

/**
 * 一个优美梦幻的动漫风 Typecho 博客主题。
 *
 * @package Fantasy Theme
 * @author Dreamer-Paul
 * @version 1.1
 * @link https://paugram.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board">
<?php while($this->next()): ?>
            <div class="post-item">
                <time class="date"><?php $this->date(); ?></time>
                <h3 class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h3>
            </div>
<?php endwhile; ?>
        </section>
        <?php $this->pageNav('', ''); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>