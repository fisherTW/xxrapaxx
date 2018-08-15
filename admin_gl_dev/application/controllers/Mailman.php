<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mailman extends CI_Controller {
 
    function sendtest(){
    	//$ary_mail = array('chunminghsu@hotmail.com,billlu@rapaq.com,ch.julius@gmail.com,davidtai777@gmail.com,feyin.tw@gmail.com,kueihsien.y@gmail.com,sophia19222000@yahoo.com.tw,sun52034@gmail.com,stin.cheng@gmail.com,jangmingking@yahoo.com.tw,ameliehsu@rapaq.com,saaliu@yahoo.com.tw,babychi@gmail.com,lanbun@gmail.com,hsieh5577@gmail.com,rong928@gmail.com,adelaide168@gmail.com,yenfu.yang@gmail.com,93401056@nccu.edu.tw,kpcw18101@gmail.com,cwwshelly@hotmail.com,hn85017889@gmail.com,linschcc@gmail.com,haibau2007@gmail.com,marieyeh@gmail.com,kaieryang@gmail.com,kathylin.tw@gmail.com,maggy0804@gmail.com,leslieliao@rapaq.com,pointknight@gmail.com,tinalikeyida@yahoo.com.tw,weifangtai@yahoo.com,ckwang@rapaq.com,spring884552@gmail.com,spiano210@yahoo.com.tw,shining0920@hotmail.com,tuesday7@gmail.com,yw0209@gmail.com,canibeyouforawhile@gmail.com,mandychu516@gmail.com,wanghanjb@gmail.com,andrea.fan@msa.hinet.net,jchou@aireton.com,Kelly.tw@gmail.com,chenchiungru100@gmail.com,sasayas@gmail.com,abk09445@gmail.com,yuwen0203@hotmail.com,daniel872526@gmail.com,nabis508@gmail.com,stud0623@yahoo.com.tw,es.elaine@msa.hinet.net,julie.tu@msa.hinet.net,donna7510300@yahoo.com.tw,itli0627@gmail.com,alexcjchen@gmail.com,vivia.c0406@gmail.com,tw0966818726@gmail.com,cmlin858@gmail.com,danapai@gmail.com,kelly.wangxx@gmail.com,sandypemg@gmail.com,candymoons@yahoo.com.tw,yafenk272607@gmail.com,chumei721@icloud.com');
    	//$ary_mail = array('fisherliao@rapaq.com,dorischen@rapaq.com');
		$this->load->library('mailgun');

		$sub = 'RapaQ 有機棉T-shirt量產發貨通知';
		$msg = '感謝大家踴躍的支持有機棉T-shirt 量產計畫,<br>
<br>
目前此計畫已經成功達標並且要進入生產了！！<br>

RapaQ 預計在7/20/2018 前將會全數出貨！！<br>

請大家再耐心期待新衣服的到來～謝謝<br>
<img src="https://storage.googleapis.com/rapaq-image/event/1.jpg">';

		foreach ($ary_mail as $v) {
			$this->mailgun
				->to('service@rapaq.com')
				->from('service@rapaq.com')
				->subject($sub)
				->message($msg)
				->bcc($v)
				->send();			
		}


    }
}