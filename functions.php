<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once("fantasy.php");

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
    paul_update("Fantasy", "1.3");

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标'), _t('在这里填入一张 png 图片地址（<a>192x192px</a>），不填则使用默认图标'));
    $form -> addInput($favicon);

    // 自定义背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('站点背景'), _t('在这里填入一张图片地址，不填则显示默认背景'));
    $form->addInput($background);

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接，不填则不输出。（格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>）'));
    $form -> addInput($home_social);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表，不填则不输出'));
    $form -> addInput($custom_css);

    // 自定义统计代码
    $custom_script = new Typecho_Widget_Helper_Form_Element_Textarea('custom_script', NULL, NULL, _t('统计代码'), _t('在这里填入你的统计代码，不填则不输出。需要 <a>&lt;script&gt;</a> 标签'));
    $form->addInput($custom_script);

    // 建站时间
    $site_created = new Typecho_Widget_Helper_Form_Element_Text('site_created', NULL, '2018/07/09', _t('建站日期'), _t('在这里填入一个建站日期（格式：<a>2018/07/09</a>），不填则无法正常输出运行时间'));
    $form -> addInput($site_created);

    // 备案号
    $verify_num = new Typecho_Widget_Helper_Form_Element_Text('verify_num', NULL, '', _t('备案号'), _t('在这里填入一个备案号，不填则无法输出'));
    $form -> addInput($verify_num);

    // 追番用户 ID
    $bgm_user = new Typecho_Widget_Helper_Form_Element_Text('bgm_user', NULL, '', _t('追番用户 ID'), _t('在这里填入一个 <a>bangumi.tv</a> 的用户 ID，用于追番页面的输出，不填则输出作者的追番记录'));
    $form -> addInput($bgm_user);

    // 页尾展示内容
    $footer_content = new Typecho_Widget_Helper_Form_Element_Checkbox('footer_content',
        array(
            'verify' => _t('备案号'),
            'link' => _t('社交链接'),
            'time' => _t('运行时间'),
            'hitokoto' => _t('随机一言')
        ),
        array('time', 'hitokoto'), _t('页尾展示内容'));
    $form -> addInput($footer_content -> multiMode());
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