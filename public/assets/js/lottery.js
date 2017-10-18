var lottery = {
    index: 0, //当前转动到哪个位置，起点位置
    count: 8, //总共有多少个位置
    timer: 0, //setTimeout的ID，用clearTimeout清除
    speed: 20, //初始转动速度
    times: 0, //转动次数
    cycle: 50, //转动基本次数：即至少需要转动多少次再进入抽奖环节
    prize: -1, //中奖位置
    init: function(id) {
        if ($("#" + id).find(".lottery-unit").length > 0) {
            $lottery = $("#" + id);
            $units = $lottery.find(".lottery-unit");
            this.obj = $lottery;
            this.count = $units.length;
            $lottery.find(".lottery-unit-" + this.index).addClass("active");
        }
    },
    roll: function() {
        var index = this.index;
        var count = this.count;
        var lottery = this.obj;
        $(lottery).find(".lottery-unit-" + index).removeClass("active");
        index += 1;
        if (index > count - 1) {
            index = 0;
        }
        $(lottery).find(".lottery-unit-" + index).addClass("active");
        this.index = index;
        return false;
    },
    stop: function(index) {
        this.prize = index;
        return false;
    }
};

function roll() {
    lottery.times += 1;
    lottery.roll();
    var prize_site = $("#lottery").attr("prize_site");
    if (lottery.times > lottery.cycle + 10 && lottery.index == prize_site) {
        var prize_name = $("#lottery").attr("prize_name");

        swal("中奖啦!", '恭喜您！获得\"' + prize_name + '\"请在“我的奖品”中查看并到指定地点领取。', "success");
        get_win_list();

        clearTimeout(lottery.timer);
        lottery.prize = -1;
        lottery.times = 0;
        click = false;
    } else {
        if (lottery.times < lottery.cycle) {
            lottery.speed -= 10;
        } else if (lottery.times == lottery.cycle) {
            var index = Math.random() * (lottery.count) | 0;
            lottery.prize = index;
        } else {
            if (lottery.times > lottery.cycle + 10 && ((lottery.prize == 0 && lottery.index == 7) || lottery.prize == lottery.index + 1)) {
                lottery.speed += 110;
            } else {
                lottery.speed += 20;
            }
        }
        if (lottery.speed < 40) {
            lottery.speed = 40;
        }
        lottery.timer = setTimeout(roll, lottery.speed);
    }
    return false;
}

/* 获取中奖列表 */
function get_win_list(){
    $.get('/lottery/get_list', function(a){
        // console.log(a);
        if(typeof a != 'object'){
            return;
        }

        html = '<h3>获奖名单</h3><ul>';
        for(k in a){
            html += '<li><span class="name">'+ a[k].name +'</span><span class="gname">'+ a[k].gname +'</span></li>';
        }
        html += '</ul>';
        $('.lottery-list').html(html);
        
        /* 中奖列表滚动插件 */
        $('.lottery-list ul').totemticker({
            row_height: '21px',
            next: '#ticker-next',
            previous: '#ticker-previous',
            stop: '#stop',
            start: '#start',
            mousestop: true
        });
    }, 'json');
}


var click = false;
$(function() {

    set_responsive();

    $(window).resize(function () {
        set_responsive();
    })

    var ajax_url = "/lottery/get_win";
    lottery.init('lottery');
    /* 开始抽奖 */
    $("#lottery a").click(function() {
        // console.log(click);
        if (click) {
            return false;
        } else {
            $.get(ajax_url, function(a) { // 获取奖品，也可以在这里判断是否登陆状态
                if(!a.code){
                    return swal("抱歉!", a.msg, "error");
                }else if(a.win){
                    $("#lottery").attr("prize_site", a.win.id);
                    $("#lottery").attr("prize_name", a.win.name);
                    lottery.speed = 100;
                    roll();
                    click = true;
                    return false;
                }else{
                    return swal("抱歉!", '通信错误，请稍后重试！', "error");;
                }
            }, "json")
        }
    });
    /*获取中奖信息*/
    get_win_list();
    
    /*抽奖响应式*/
    function set_responsive (){
        var lv = parseFloat(parseInt($('#lottery').width()) / 682);
        $('#lottery').css({'height' : Math.floor(684 * lv) + 'px'});
        $('#lottery table').css({'top' : Math.floor(62 * lv) + 'px', 'left' : Math.floor(64 * lv) + 'px'});
        $('#lottery table td').css({'width' : Math.floor(180 * lv) + 'px', 'height' : Math.floor(180 * lv) + 'px' });
        $('#lottery table td img').css({'width' : Math.floor(180 * lv) + 'px', 'height' : Math.floor(180 * lv) + 'px', 'margin-top' : Math.floor(10 * lv) + 'px'});
        $('#lottery table td a').css({'width' : Math.floor(180 * lv) + 'px', 'height' : Math.floor(180 * lv) + 'px' });
        $('.mask').css({'width' : Math.floor(180 * lv) + 'px', 'height' : Math.floor(180 * lv) + 'px', 'margin-top' : Math.floor(3 * lv) + 'px' });
        $('.lottery-head').css({'height' : Math.floor(286 * lv) + 'px'});
        $('.lottery-list').css({'margin-left' : Math.floor(20 * lv) + 'px', 'margin-right' : Math.floor(20 * lv) + 'px'});
    }
})