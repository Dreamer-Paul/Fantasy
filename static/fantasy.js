/* ----

# Fantasy Theme
# By: Dreamer-Paul
# Last Update: 2018.12.1

一个优美梦幻的动漫风 Typecho 博客主题。

本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var Fantasy_Theme = function (config) {
    var that = this;
    var element = {
        toggle: ks.select("header .toggle"),
        search: {
            btn: ks.select(".search-btn"),
            window: ks.select(".side-window"),
            input: ks.select(".side-window input")
        },
        content: ks.select(".post-content"),
        comment: {
            form: ks.select(".comment-form"),
            list: ks.select(".comment-list"),
            mail: document.getElementsByName("mail")[0],
            avatar: ks.select(".comment-avatar img")
        },
        top: ks.select(".to-top"),
        date: ks.select(".foot-date"),
        hitokoto: ks.select(".foot-hitokoto")
    };

    // 菜单按钮
    this.header = function () {
        element.toggle.onclick = function () {
            ks.select("aside").classList.toggle("active");
        };

        element.search.btn.onclick = function () {
            element.search.input.focus();
            element.search.window.classList.toggle("active");
        };
    };
    this.header();

    // 自动添加外链
    this.links = function (selector) {
        var links = selector.getElementsByTagName("a");

        for(var i = 0; i < links.length; i++){
            links[i].target = "_blank";
        }
    };

    if(element.content){
        this.links(element.content);
    }
    if(element.comment.list){
        this.links(element.comment.list);
    }

    // 评论
    this.comments = function () {
        element.comment.mail.onblur = function (event) {
            var reg = /@[a-zA-Z0-9]{2,10}(?:\.[a-z]{2,4}){1,3}$/;

            if(reg.test(event.target.value)){
                element.comment.avatar.src = "?action=gravatar&email=" + event.target.value;
            }
        }
    };

    // 评论
    if(element.comment.form && element.comment.mail){
        this.comments();
    }

    // 返回头部
    this.to_top = function () {
        element.top.onclick = ks.scrollTop;

        window.onscroll = function () {
            var scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
            scroll >= window.innerHeight ? element.top.classList.add("active") : element.top.classList.remove("active");
        }
    };
    this.to_top();

    // 运行时间
    this.foot_date = function (date) {
        function run_date(date){
            var created = Date.parse(date);
            var now = new Date().getTime();
            var ran = now - created;

            var day = ran / 86400000;
            var day_c = Math.floor(day);

            var hour = 24 * (day - day_c);
            var hour_c = Math.floor(hour);

            var min = 60 * (hour - hour_c);
            var min_c = Math.floor(min);

            var sec = Math.floor(60 * (min - min_c));

            return "站点已萌萌哒存活了 <a>" + day_c + "</a> 天 <a>" + hour_c + "</a> 小时 <a>" + min_c + "</a> 分 <a>" + sec + "</a> 秒";
        }

        setInterval(function () {
            element.date.innerHTML = run_date(date);
        }, 1000);
    };

    if(element.date && config.created){
        this.foot_date(config.created);
    }

    // 一言
    this.hitokoto = function () {
        ks.ajax({
            method: "GET",
            url: "https://v1.hitokoto.cn",
            success: function (req){
                element.hitokoto.innerText = JSON.parse(req.response)["hitokoto"];
            },
            failed: function (req){
                ks.notice("请求一言失败！", {color: "red"});
            }
        });
    };

    if(element.hitokoto){
        this.hitokoto();
    }
};

// 图片缩放
ks.image(".post-content:not(.exclude-image) img");

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("%c Fantasy %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #ffa9be;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}