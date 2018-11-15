/* ----

# Fantasy Theme
# By: Dreamer-Paul
# Last Update: 2018.11.15

一个优美梦幻的动漫风 Typecho 博客主题。

本代码为奇趣保罗原创，并遵守 MIT 开源协议。欢迎访问我的博客：https://paugram.com

---- */

var fantasy = new function () {
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
        }
    };

    element.toggle.onclick = function () {
        ks.select("aside").classList.toggle("active");
    };

    element.search.btn.onclick = function () {
        element.search.input.focus();
        element.search.window.classList.toggle("active");
    };

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
};

// 图片缩放
ks.image(".post-content img");

// 请保留版权说明
if (window.console && window.console.log) {
    console.log("%c Fantasy %c https://paugram.com ","color: #fff; margin: 1em 0; padding: 5px 0; background: #ffa9be;","margin: 1em 0; padding: 5px 0; background: #efefef;");
}