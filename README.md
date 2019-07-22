# Arukas Docker SS base64加密插件

[Arukas Docker app 下载 [v1.5.5]](https://play.google.com/store/apps/details?id=com.xbw.arukas)

## 1.插件提交

```JSON
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
```

-------

## 2.Docker 镜像
`hyperapp/shadowsocks-libev`

-------

## 3.ENV 设置
PASSWORD = password
METHOD = aes-256-cfb (默认 chacha20)

-------

## 4.Port
8388 TCP
8388 UDP

-------

## 5.截图
![046842686303661F5DCF5F1272BD37E5](media/15637795215872/046842686303661F5DCF5F1272BD37E5.jpg)



