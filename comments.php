<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

    <div class="comment-item" id="<?php $comments->theId(); ?>">
        <?php $comments->gravatar('150', 'wavatar'); ?>
        <div class="content">
            <div class="comment-meta">
                <span class="comment-author"><?php $comments->author(); ?></span>
                <time class="comment-time"><?php $comments->date(); ?></time>
                <span class="comment-reply"><?php $comments->reply(); ?></span>
            </div>
            <?php $comments->content(); ?>
        </div>
<?php if ($comments->children) { ?>
        <div class="comment-children">
            <?php $comments->threadedComments($options); ?>
        </div>
<?php } ?>
    </div>
<?php } ?>

<?php if($this->allow('comment')): ?>
        <section class="board">
            <h3>参与讨论</h3>
            <?php $this->comments()->to($comments); ?>
            <div id="<?php $this->respondId(); ?>">
                <form class="comment-form" id="<?php $this->respondId(); ?>" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                    <div class="cancel-reply"><?php $comments->cancelReply(); ?></div>
                    <figure class="comment-avatar">
<?php if($this->user->hasLogin()): ?>
                        <img src="<?php echo Typecho_Common::gravatarUrl($this->user->mail, 150, 'X', 'mm', true) ?>"/>
<?php else: ?>
                        <img src="<?php $this->options->themeUrl('static/img/avatar.jpg'); ?>"/>
<?php endif; ?>
                    </figure>
                    <fieldset>
                        <textarea rows="2" name="text" placeholder="说下感想吧！" required><?php $this->remember('text'); ?></textarea>
<?php if(!$this->user->hasLogin()): ?>
                        <input type="text" name="author" placeholder="昵称 *：" value="<?php $this->remember('author'); ?>" required="">
                        <input type="email" name="mail" placeholder="电邮 *：" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                        <input type="url" name="url" placeholder="http://" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
<?php else: ?>
                        <p class="logined"><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>，欢迎回来！不是你？<a href="<?php $this->options->logoutUrl(); ?>" title="登出">登出</a></p>
<?php endif; ?>
                        <button class="btn submit" type="submit"></button>
                    </fieldset>
                </form>
            </div>
<?php if ($comments->have()): ?>
        <?php $comments->listComments(array('before' => '<div class="comment-list">', 'after' => '</div>')); ?>
        <?php $comments->pageNav('', ''); ?>
<?php else: ?>
    <p class="no-comment">还没有评论呢！</p>
<?php endif; ?>
<?php endif; ?>
        </section>