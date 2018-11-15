<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {

    // 插件信息与更新检测
    function paul_update($name, $version){
        echo "<style>.paul-info{text-align:center; margin:1em 0;} .paul-info > *{margin:0 0 1rem} .buttons a{background:#467b96; color:#fff; border-radius:4px; padding:.5em .75em; display:inline-block}</style>";
        echo "<div class='paul-info'>";
        echo "<h2>Fantasy 主题 (".$version.")</h2>";
        echo "<p>By: <a href='https://github.com/Dreamer-Paul'>Dreamer-Paul</a></p>";
        echo "<p class='buttons'><a href='https://paugram.com/coding/fantasy-theme.html'>项目介绍</a>
              <a href='https://github.com/Dreamer-Paul/Fantasy/releases'>更新日志</a></p>";

        $update = file_get_contents("https://api.paugram.com/update/?name=".$name."&current=".$version."&site=".$_SERVER['HTTP_HOST']);
        $update = json_decode($update, true);

        if(isset($update['text'])){echo "<p>".$update['text']."</p>"; };
        if(isset($update['message'])){echo "<p>".$update['message']."</p>"; };

        echo "</div>";
    }
    paul_update("Fantasy", "1.1");

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标'), _t('在这里填入一张 png 图片地址（<a>192x192px</a>），不填则使用默认图标'));
    $form->addInput($favicon);

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form->addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出。'));
    $form->addInput($custom_css);

    // 自定义统计代码
    $custom_script = new Typecho_Widget_Helper_Form_Element_Textarea('custom_script', NULL, NULL, _t('统计代码'), _t('在这里填入你的统计代码，不填则不输出。需要 <a>&lt;script&gt;</a> 标签。'));
    $form->addInput($custom_script);
}

function themeInit($archive){

    // AJAX 头像
    if(isset($_GET['action']) && $_GET['action'] == 'gravatar' && $_GET['email']){
        $host = 'https://secure.gravatar.com/avatar/';
        $email = strtolower($_GET['email']);
        $hash = md5($email);

        $reply = $host . $hash . '?d=robohash';

        header("location: $reply");
        die();
    }
}