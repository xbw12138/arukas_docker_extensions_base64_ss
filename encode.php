<?php
if(isset($_GET['url'])){
    $contents = $_GET['url'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
        <title>SS加密-Image hyperapp/shadowsocks-libev</title>
        <!-- 引入 FrozenUI -->
        <link rel="stylesheet" href="http://i.gtimg.cn/vipstyle/frozenui/2.0.0/css/frozen.css"/>
    </head>
    <body>
        <ul class="ui-list ui-list-single ui-list-link ui-border-tb">
        <?php 
            $array = json_decode($contents,true);
            $port_mappings = $array['data']['data']['attributes']['port-mappings'];
            $environment = $array['data']['data']['attributes']['environment'];
            $METHOD = "chacha20";
            $PASSWORD = "";
            foreach ($environment as $env){
                if($env['key'] == "PASSWORD"){
                    $PASSWORD = $env['value'];
                }
                if($env['key'] == "METHOD"){
                    $METHOD = $env['value'];
                }
            }
            foreach ($port_mappings as $value_port) {
                foreach ($value_port as $value){
                    $container_port = $value['container-port'];
                    $host = $value['host'];
                    $protocol = $value['protocol'];
                    $service_port = $value['service-port'];
                    $isMatched = preg_match_all('/-\d{0,3}\-\d{0,3}\-\d{0,3}\-\d{0,3}/', $host, $matches);
                    if($isMatched){
                        ?>
                        <li class="ui-border-t">
                            <div class="ui-list-info">
                                <h4>Protocol</h4>
                                <div class="ui-txt-info"><?php echo $protocol;?></div>
                            </div>
                        </li>
                        <li class="ui-border-t">
                            <div class="ui-list-info">
                                <h4 class="ui-nowrap">Container Port</h4>
                                <div class="ui-txt-info"><?php echo $container_port;?></div>
                            </div>
                        </li>
                        <li class="ui-border-t">
                            <div class="ui-list-info">
                                <h4 class="ui-nowrap">Service Port</h4>
                                <div class="ui-txt-info"><?php echo $service_port;?></div>
                            </div>
                        </li>
                        <li class="ui-border-t">
                            <div class="ui-list-info">
                                <h4 class="ui-nowrap">SS</h4>
                                <div class="ui-form-item ui-border-b">
                                    <input type="text" style="width:100%" value="<?php echo "ss://".base64_encode($METHOD.":".$PASSWORD."@".str_replace("-",".",ltrim($matches[0][0], "-")).":".$service_port);?>">
                                </div>
                            </div>
                        </li>
                        <br><hr><br>
                        <?php
                    }else{?>
                        <div class="ui-dialog ui-dialog-operate ui-dialog-operate-icon show">
                            <div class="ui-dialog-cnt">
                                <div class="ui-dialog-bd">
                                    <h3>解析错误</h3>
                                </div>
                                <div class="ui-dialog-ft">
                                    <button class="ui-btn-lg">确定</button>
                                </div>
                                <i class="ui-dialog-close" data-role="button"></i>
                            </div>
                        </div>
                    <?php }
                }
            }
        ?>
        </ul>
    </body>
</html>
