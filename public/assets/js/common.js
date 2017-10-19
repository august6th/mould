$(function(){

    $('.share_btn').click(function () {
        if( $(window).width() >= 375) {
            var imgSize = "300x239";
        } else {
            var imgSize = "250x199";
        }
        swal({
                title: "分享邀请函",
                text: "第一步 - 打开应用的导航栏。",
                imageUrl: "/assets/img/wechat_btn.jpg",
                imageSize: imgSize,
                confirmButtonText: "下一步",
                closeOnConfirm: false
            },
            function(){
                swal({
                    title:"分享邀请函",
                    text: "第二步 - 分享到你的社交圈。",
                    imageUrl: "/assets/img/zone.png",
                    imageSize: "200x66",
                    confirmButtonText: "去分享"
                });
            });
        $('.sa-button-container').css({'margin-bottom': '20px'});
    });
});