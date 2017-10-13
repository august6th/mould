var lottery = {
    index: 0, //当前转动到哪个位置，起点位置
    count: 16, //总共有多少个位置
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
        $('body').dialog({
            type:'success',
            title:'中奖啦！',
            showBoxShadow:true,
            buttons:[{name: '确定',className: 'defalut'}],
            discription:'恭喜您！获得\"' + prize_name + '\"</br>请在“我的奖品”中查看并领取。',
            buttonsSameWidth:true,
            animateIn:'rotateInUpLeft-hastrans',
            animateOut:'rotateOutUpLeft-hastrans'}, function(){
            get_win_list();
        });

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

        html = '<ul>';
        for(k in a){
            html += '<li><span>'+ a[k].name +'</span><span>'+ a[k].gname +'</span></li>';
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
    var ajax_url = "/lottery/get_win";
    lottery.init('lottery');
    /* 开始抽奖 */
    $("#lottery a").click(function() {
        console.log(click);
        if (click) {
            return false;
        } else {
            $.get(ajax_url, {uid: 1}, function(a) { // 获取奖品，也可以在这里判断是否登陆状态
                if(!a.code){
                    var _url = a.status == 2 ? '/login' : '/login';
                    return $('body').dialog({type:'danger',discription:a.msg});
                }else if(a.win){
                    $("#lottery").attr("prize_site", a.win.id);
                    $("#lottery").attr("prize_name", a.win.name);
                    lottery.speed = 100;
                    roll();
                    click = true;
                    return false;
                }else{
                    return $('body').dialog({type:'danger',discription:"通讯错误 稍后再试"});
                }
            }, "json")
        }
    });
    /*获取中奖信息*/
    get_win_list();
})