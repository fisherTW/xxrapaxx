<!DOCTYPE html>
<html lang="zh_TW">

<head>
    <meta charset="UTF-8">
    <title>感謝支持│RapaQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <style>
    body,
    html {
        margin: 0;
        padding: 0;
    }
    </style>
</head>

<body>
    <div class="wrapper" style="font-family:'Microsoft JhengHei',arial;background-color: #f8f8f8;margin:0 auto;padding:0;width:100%; color:#2e2e2e; font-size: 16px;line-height: 1.5; padding-top: 3%" bgcolor="#f8f8f8">
        <div class="box" style="background:#ffffff;margin:0px auto;max-width:600px;min-width:280px; ">
            <div class="order" style="margin:0 auto;max-width:520px;min-width:280px;padding-top:10%;padding-bottom: 10%;width:94%; background-color:#ffffff;">
            	<!-- 訂單資訊 -->
                <div class="order-name">
                    <div style="">親愛的 <?php echo $info['rec_name'];?></div>
                    <div style="color:#666666; margin-top:20px">
                        感謝您的購買與支持！ 
						<br>
						請完成繳款。
						<br>
						繳款期限不受例假日影響，請在繳費期限內以前繳費，越早轉帳，RapaQ 就能優先處理您的訂單！
						<br>
                        以下是您訂購資訊，也可以於個人頁面的「<a href="<?= base_url().'member/order' ?>" target="_blank" style="color:#d01120;text-decoration: none;">訂單查詢</a>」 查詢訂單明細。
                    </div>
                </div>
                <?php //pre($info['order']);exit;?>
                <!-- 訂單明細 -->
                <div class="order-content" style="background-color: #f8f8f8;padding: 10px;margin-top: 20px">
                	<!-- 訂單資訊 -->
                    <ul class="order-num" style="background-color: #ffffff;list-style:none;margin:0;padding:0">
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">訂單編號</div>
                            <div style="color:#666666;display: inline-block;">#<?= $info['order_id'];?>
                            </div>
                        </li>
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">訂單日期</div>
                            <div style="color:#666666;display: inline-block;"><?=  $info['dt_create'];?>
                            </div>
                        </li>
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">訂單狀態</div>
                            <div style="color:#666666;display: inline-block;">訂單成立</div>
                        </li>
<!--                        
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">付款方式</div>
                            <div style="color:#666666;display: inline-block;">-</div>
                        </li>
-->                        
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">繳費期限</div>
                            <div style="color:#666666;display: inline-block;"><?=  date("Y-m-d 23:59:59",strtotime($info['dt_create'])+60*60*24*2);?></div>
                        </li>
                        <li style="padding:10px;">
                            <div style="font-weight: bold;display: inline-block;width:74px">付款狀態</div>
                            <div style="color:#666666;display: inline-block;">未付款</div>
                        </li>
                        <li style="padding:10px;border-top: 2px solid #f8f8f8">
                            <div style="font-weight: bold;display: inline-block;width:74px">訂單總額
                            </div>
                            <div style="color:#d01120;display: inline-block;font-weight: 700;font-family: 'Poppins', sans-serif;"><?= $info['amt']?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div style="color:#666666; margin-top:20px">
                    本通知函只是通知您本系統已收到您的訂購訊息、並供您再次自行核對之用，不代表交易已完成。<br><br>
                    ※ 此信件為系統發出信件，請勿直接回覆。
                </div>
            </div>
        </div>
        <div class="footer" style="margin-left:auto; margin-right:auto;margin-top:50px;padding-left: 14px;padding-right: 14px;max-width:600px;min-width:280px; padding-bottom: 20px">
            <div style="border-bottom: 1px solid #dddddd;padding-bottom: 16px;text-align: center;">
                <img src="<?= base_url() ?>assets/img/logo-black.png" alt="" width="154" height="66">
            </div>
            <ul style="font-size: 12px;margin: 0;padding-top: 20px;padding-left:0;padding-right:0; list-style: none;text-align: center;color:#666666">
                <li>客服信箱：service@rapaq.com </li>
                <li>客服專線：(02)7708-5090</li>
                <li>週一~週五 AM9:30~12:00、PM13:30~18:00 (國定例假日除外)</li>
                <li>愛魅客國際股份有限公司</li>
                <li>台北市南港區三重路19之11號4樓</li>
            </ul>
        </div>
    </div>
</body>

</html>