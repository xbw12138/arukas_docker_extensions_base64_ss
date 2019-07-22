<?php
header('Content-type: application/json; charset=UTF-8');
$json='{
    "statuscode":200,
    "data":[
        {
            "appname":"东灵山",
            "packagename":"com.xbw.mvp",
            "icon":"http://pic.ecfun.cc/15319632485b4fe770a11a4468221",
            "functioncode":101,
            "functionname":"VPN，镜像请使用xbw12138/auto-shadowsocks:latest 端口：8989 tcp",
            "activity":"com.xbw.mvp.ui.MainActivity",
            "flag":"datajson",
            "appstore":"https://fir.im/r95s"
        },
        {
            "appname":"东灵山",
            "packagename":"com.xbw.mvp",
            "icon":"http://pic.ecfun.cc/15319632485b4fe770a11a4468221",
            "functioncode":102,
            "functionname":"分享SS，镜像请使用xbw12138/auto-shadowsocks:latest 端口：8989 tcp",
            "activity":"com.xbw.mvp.ui.MainActivity",
            "flag":"datajson",
            "appstore":"https://fir.im/r95s"
        },
        {
            "appname":"SS加密链接获取",
            "packagename":"",
            "icon":"http://pic.ecfun.cc/15319632485b4fe770a11a4468221",
            "functioncode":103,
            "functionname":"使用hyperapp/shadowsocks-libev，设置ENV PASSWORD,METHOD=chacha20",
            "activity":"",
            "flag":"datajson",
            "appstore":"http://ecfun.cc/vpn/encode.php?url=",
            "type":"web"
        }
    ]
}';
echo json_encode(json_decode($json));