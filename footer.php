<footer>
    <section class="foot-widget">
        <div class="wrap min">
            <div class="row">
                <div class="col-m-4">
                    <h3>最新文章：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Contents_Post_Recent', 'pageSize=6') -> parse('<li><a href="{permalink}" target="_blank">{title}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3>时光机：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月&limit=6') -> parse('<li><a href="{permalink}" rel="nofollow" target="_blank">{date}</a></li>'); ?>
                    </ul>
                </div>
                <div class="col-m-4">
                    <h3>最近评论：</h3>
                    <ul>
                        <?php $this -> widget('Widget_Comments_Recent', 'pageSize=6') -> to($comments); ?>
                        <?php while($comments -> next()): ?>
                            <li><?php $comments -> author(false); ?>: <a href="<?php $comments -> permalink(); ?>" rel="nofollow" target="_blank"><?php $comments -> excerpt(10, '...'); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="foot-copyright">
        <p>&copy; <?php echo date('Y') ?> <a href="<?php $this -> options -> siteUrl() ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Theme By <a href="https://github.com/Dreamer-Paul/Fantasy" target="_blank" rel="nofollow">Fantasy</a>.</p>
    </section>
</footer>

<script src="<?php $this->options->themeUrl('static/kico.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('static/fantasy.js'); ?>"></script>
<?php $this -> options -> custom_script() ?>
<?php $this -> footer() ?>

</body>
</html>