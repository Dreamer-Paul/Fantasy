<?php

/**
 * 追番
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$this->need('header.php');

?>
<main>
    <div class="wrap min">
        <section class="board">
            <div class="post-title">
                <h2><?php $this->title() ?></h2>
            </div>
            <article class="post-content exclude-img">
                <div class="row">
                    <?php Fantasy::bangumi($this); ?>
                </div>
            </article>
        </section>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>