<?php

class Fantasy {
    // HTTPS 转换
    static function convert_https($url){
        return preg_replace("/^http:/", "https:", $url);
    }

    // 追番
    static function bangumi($t){
        $uid = Typecho_Widget::widget('Widget_Options') -> bgm_user;
        $uid = $uid ? $uid : 433599;
        $bgm = file_get_contents("https://api.bgm.tv/user/" . $uid . "/collection?cat=playing");
        $bgm = json_decode($bgm);

        if($bgm){
            foreach($bgm as $item){
                $bid  = $item -> subject -> id;
                $name = $item -> subject -> name_cn ? $item -> subject -> name_cn : $item -> subject -> name;
                $seem = $item -> ep_status;
                $image = self::convert_https($item -> subject -> images -> large);
                $total = property_exists($item -> subject, "eps_count") ? $item -> subject -> eps_count : $seem;
                $width = (int)$seem / $total * 100;
?>
                    <div class="col-6 col-m-4">
                        <a class="bangumi-item" target="_blank" href="https://bgm.tv/subject/<?php echo $bid ?>">
                            <div class="bangumi-img" style="background-image: url(<?php echo $image ?>)">
                                <div class="bangumi-status">
                                    <div class="bangumi-status-bar" style="width: <?php echo $width ?>%"></div>
                                    <p>进度：<?php echo $seem ?> / <?php echo $total ?></p>
                                </div>
                            </div>
                            <h3><?php echo $name ?></h3>
                        </a>
                    </div>
<?php
            }
        }
        else{
?>
                    <div class="col-12">
                        <p>追番数据获取失败，请检查如下细节：</p>
                        <ul>
                            <li>用户 ID 是否正确？</li>
                            <li>该用户是否在“在看”添加了番剧？</li>
                            <li>服务器能否正常连接 <code>api.bgm.tv</code> ？</li>
                        </ul>
                    </div>
<?php
        }

        unset($bid, $name, $seem, $total, $img, $width);
    }

    // 时间转换
    static function tran_time($ts){
        $dur = time() - $ts;

        if($dur < 0){
            return $ts;
        }
        else if($dur < 60){
            return $dur . ' 秒前';
        }
        else if($dur < 3600){
            return floor($dur / 60) . ' 分钟前';
        }
        else if($dur < 86400){
            return floor($dur / 3600) . ' 小时前';
        }
        else if($dur < 604800){ // 七天内
            return floor($dur / 86400) . ' 天前';
        }
        else if($dur < 2592000){ // 一个月内
            return floor($dur / 604800) . " 周前";
        }

        else{
            return date("y.m.d", $ts);
        }
    }

    // 上次登录
    static function get_last_login(){
        $db = Typecho_Db::get();
        $query = $db -> select() -> from('table.users');
        $logged = $db -> fetchRow($query)["logged"];

        return self::tran_time($logged);
    }
}