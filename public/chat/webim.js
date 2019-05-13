$(function () {
    webim.init();

    $(".message .send").click(function () {
        webim.sendMsg();
    });
});
let config = {
    server: "ws://127.0.0.1:9501"
};

let webim = {
    data: {
        wsServer: null,
        info: {}
    },
    init: function () {
        this.data.wsServer = new WebSocket(config.server);
        this.open();
    },
    open: function () {
        this.data.wsServer.onopen = function (e) {
            webim.notice("连接成功");
        }
    },
    scrollBottom: function () {
        let chat_list = $('.chat-list');
        chat_list.scrollTop(chat_list[0].scrollHeight);
    },
    notice: function (msg) {
        var html = '<div class="col-xs-12 notice text-center">' + msg + '</div>';
        $('.chat-list').append(html);

        this.scrollBottom();
    },
};