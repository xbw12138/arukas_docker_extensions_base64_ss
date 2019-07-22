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
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
    </head>
    <body>
        <ul class="list-group">
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
                        $host = str_replace("-",".",ltrim($matches[0][0], "-"));
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Protocol
                            <span class="badge badge-primary badge-pill"><?php echo $protocol;?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Container Port
                            <span class="badge badge-primary badge-pill"><?php echo $container_port;?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Service Port
                            <span class="badge badge-primary badge-pill"><?php echo $service_port;?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        Host
                            <span class="badge badge-primary badge-pill"><?php echo $host;?></span>
                        </li>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" style="text-align:center" value="<?php echo "ss://".base64_encode($METHOD.":".$PASSWORD."@".$host.":".$service_port);?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="QRcode('<?php echo "ss://".base64_encode($METHOD.":".$PASSWORD."@".$host.":".$service_port);?>')">二维码</button>
                            </div>
                        </div>
                        <hr><br>
                        <?php
                    }else{?>
                        <div class="alert alert-primary" role="alert">解析错误</div>
                    <?php }
                }
            }
        ?>
        </ul>
        <button type="button" hidden="hidden" data-toggle="modal" data-target="#dialog_qrcode"
        id="open_qrcode"></button>
        <div class="modal" tabindex="-1" role="dialog" id="dialog_qrcode">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">SS QRcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center><div id="qrcode"></div></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function QRcode(ss){
            jQuery('#qrcode').empty();
            $("#open_qrcode").click();
            jQuery('#qrcode').qrcode(ss); 
        }
    </script>
</html>