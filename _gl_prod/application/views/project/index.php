<link rel="stylesheet" href="<?= base_url() ?>assets/css/QMaker.css">

<header class="header_theme header_QMaker"><a href="<?= base_url() ?>project/list">計畫探索</a><a href="<?= base_url() ?>project/launch">發起計畫</a><a href="<?= base_url() ?>factory/list">募設計夥伴</a></header>
<input type='hidden' id='hid_baseurl' value='<?= base_url() ?>'>
<input type='hidden' id='hid_projectId' value='<?= $info['id'] ?>'>
<div class="div_mask"></div>
<div class="div_maskForSearch"></div>
<div class="div_home">
	<div class="container-fluid div_PlanProject" style="background-image:url('<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>'); margin-top: 100px;">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-7 div_phoneFull">
<?php if($info['video_cover'] != ''): ?>		
					<iframe width="653" height="430" src="<?= $info['video_cover'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<?php else: ?>
					<img src="<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>">
<?php endif; ?>
				</div>
				<div class="col-xs-12 col-md-5">
					<div class="div_hotPlanInner">
						<div class="div_tag">
							<?php if($info['is_recommend'] == 1): ?>
							<div class="div_tagEach div_tagPurple">募設計推薦</div>
							<?php endif; ?>
							<?php if($info['is_recommend_expert'] == 1): ?>
							<div class="div_tagEach div_tagBlack">專家推薦</div>
							<?php endif; ?>
							<div class="div_share">
								<!-- FB分享鈕 ?u=後面接網址-->
								<button class="div_tagEach btn_fb" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href)">FB</button>
								<!-- LINE分享鈕 接網址處在樓下-->
								<button class="div_tagEach btn_line" id="share_line" >LINE</button>
								<!-- 微博分享鈕 -->
								<button class="div_tagEach btn_weibo" onclick="window.open('http://service.weibo.com/share/share.php?url=' + window.location.href + '&title=<?= $info['name'] ?>&pic=<?= URL_GOOGLE_IMG.$info['pic_cover'] ?>')" target="_blank">weibo</button>
							</div>
						</div>
<?php
	if($info['goal'] >0) {
		$info['percent_now'] = floor($info['total']/$info['goal']*100);
		$info['percent_now'] = $info['percent_now'] > 100 ? 100 : $info['percent_now'];
		$dt_now		= new DateTime();
		$dt_exp_end = new DateTime($info['dt_exp_end']);
		$interval	= date_diff($dt_exp_end, $dt_now);
		$info['datediff']	= ($dt_now > $dt_exp_end) ? '0' : $interval->format('%a');

		$info['percentNow'] = floor($info['total']/$info['goal']*100);
	}
?>							
						<div class="div_hotPlanTitle"><?= $info['name'] ?></div>
						<div class="div_hotPlaner">提案人<a href="<?= base_url() ?>project/launcher/<?= $info['user_id'] ?>"><?= $info['user_name'] ?></a></div>
						<div class="div_hotPlanContent"><?= $info['profile'] ?></div>
						<div class="div_timeIsMoneyTop"><span> $<?= number_format($info['total'], 0, '.' ,',') ?></span>
							<div class="pull-right">目標 $<?= number_format($info['goal'], 0, '.' ,',') ?></div>
						</div>
						<div class="progress">
							<div class="progress-bar" style="width:<?= $info['percent_now'] ?>%;" role="progressbar" aria-valuenow="<?= $info['percent_now'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>				
						<div class="div_timeIsMoney">達成率<span><?= $info['percentNow'] ?>%</span>
							<div class="pull-right">倒數<span><?= $info['datediff'] ?></span>天</div>
						</div>
						<div class="div_btnAll">
							<button id='btn_like' class="btn_like <?= $isMyBookmark ? 'btn_arrive' : ''?>" onclick="location.href='javascript:void(0)'" value="like"><img class="svg" src="<?= base_url() ?>assets/img/icon_tools/save.svg" alt=""></button>
							<button class="btn_purple btn_support" onclick="location.href='javascript:void(0)'" value="support">支持計畫</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid div_PlanProjectTabBar">
		<div class="row">
			<div class="container">
				<ul class="row nav nav-tabs" role="tablist">
					<li class="active col-md-2 col-xs-3" role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"></a></li>
					<li class="col-md-2 col-xs-3" role="presentation"><a href="#status" aria-controls="status" role="tab" data-toggle="tab"></a></li>
					<li class="col-md-2 col-xs-3" role="presentation" id='li_qa'><a href="#qa" aria-controls="qa" role="tab" data-toggle="tab"></a></li>
					<li class="col-md-2 col-xs-3" role="presentation"><a href="#common" aria-controls="common" role="tab" data-toggle="tab"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="tab-content row">
					<div class="tab-pane active col-md-8 col-xs-12" id="details" role="tabpanel"><?= $info['detail'] ?></div>
					<div class="tab-pane col-md-8 col-xs-12" id="status" role="tabpanel">
<?php if(count($info['updates']) > 0): ?>
<?php $seq = count($info['updates']) ?>
<?php foreach ($info['updates'] as $updates): ?>					
						<div class="updates">
							<p class="p_title">計畫更新 #<?= $seq ?> ． <?= date("Y 年 m 月 d 日", strtotime($updates['dt_create'])) ?></p>
							<p><?= $updates['content'] ?></p>
						</div>
<?php $seq -- ?>
<?php endforeach; ?>
<?php else: ?>
						目前無計畫更新資料
<?php endif; ?>
					</div>
					<div class="tab-pane col-md-8 col-xs-12" id="qa" role="tabpanel">
<?php if(isset($_SESSION['sess_user_id'])): ?>
						<!-- 登入狀態 增加.div_commentsTextareaLogin-->
						<div class="div_commentsTextarea div_commentsTextareaLogin">
							<div class="div_commentsHead"><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=160"></div>
							<textarea placeholder="請輸入..." id='txt_content'></textarea>
							<button type='button' id='btn_send'>送出</button>
						</div>
<?php endif; ?>			
<?php if(count($info['comments']) > 0): ?>			
<?php foreach($info['comments'] as $qaitem): ?>
						<div class="div_commentsEach">
							<div class="div_commentsHead"><img src="https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=160"></div>
							<p class="p_name"><?= $qaitem['q_user_name'] ?><span><?= date("Y 年 m 月 d 日", strtotime($qaitem['dt_create'])) ?></span></p>
							<p><?= $qaitem['content'] ?></p>
<?php if($qaitem['reply'] != ''): ?>						
							<div class="div_commentsReply">
								<p class="p_name">發起人<span><?= date("Y 年 m 月 d 日", strtotime($qaitem['dt_update'])) ?></span></p>
								<p><?= $qaitem['reply'] ?></p>
							</div>
<?php endif; ?>
						</div>
<?php endforeach; ?>
<?php else: ?>
					目前無留言資料
<?php endif; ?>
					</div>
					<div class="tab-pane col-md-8 col-xs-12" id="common" role="tabpanel">
						<div class="div_faqYes">
							<ul>
<?php if(count($info['faq']) > 0): ?>
<?php $tmp_count = 0; ?>
<?php foreach($info['faq'] as $item): ?>
<?php $tmp_count++; ?>
								<li>
									<div class="div_arrow">
										<img class="svg" src="<?= base_url() ?>assets/img/icon_function/next-black.svg">
									</div>
									<span>Q<?= $tmp_count ?>:</span><?= $item['q'] ?>
									<div class="div_answer">
										<span>A<?= $tmp_count ?>:</span><?= $item['a'] ?></div>
								</li>
<?php endforeach; ?>
<?php endif; ?>
							</ul>
						</div>
						<div class="div_faqNo">還有其他問題嗎？至<a href="#qa" aria-controls="qa" role="tab" data-toggle="tab" onclick='onclkTabQa();'>留言</a>直接問發起人！</div>						
					</div>
					<!-- 右邊計畫-->
					<div class="col-md-4 col-xs-12 div_support">
						<div class="row">
							<div class="col-xs-12">
								<h3>支持計畫</h3>
							</div>
<?php if(count($ary_product) > 0): ?>
<?php foreach($ary_product as $item): ?>								
							<div class="col-xs-12">
								<div class="div_PlanRight"><img src="<?= URL_GOOGLE_IMG.$item['url_pic'] ?>">
									<div class="div_PlanRightInner">
										<div class="row div_PlanRightRowA">
											<div class="col-xs-7 div_PlanRightTitle">
												<p><?= $item['name'] ?></p>
											</div>
											<div class="col-xs-5 div_PlanRightPrice">
												<p class="text-right" name='txt_price_deal' value='<?= $item["price_deal"] ?>'>$<?= number_format($item['price_deal'], 0, '.' ,',') ?></p>
											</div>
										</div>
										<div class="row div_PlanRightRowB">
											<div class="col-xs-12">
												<p><?= $item['quantity_total'] ?> 人支持</p>
<?php if($item['show_limit'] != '65535'): ?>
												<p class="p_red">限量 <?= $item['show_limit'] ?> 份</p>
<?php endif; ?>
											</div>
										</div>
										<div class="row div_PlanRightRowC">
											<div class="col-xs-12">
												<p><?= $item['detail'] ?></p>
											</div>
										</div>
										<!-- 反灰+ disabled -->
<?php if($item['quantity'] == 0): ?>
										<div class="row div_PlanRightRowE">
											<div class="col-xs-12">
												<button disabled>銷售一空</button>
											</div>
										</div>
<?php elseif($item['is_show'] == '0'): ?>
										<div class="row div_PlanRightRowE">
											<div class="col-xs-12">
												<button disabled>已截止</button>
											</div>
										</div>
<?php else: ?>
										<div class="row div_PlanRightRowE">
<!-- 											<div class="col-xs-6">
												<button class="btn_add" name='btn_add' act='1' product_id='<?= $item["id"] ?>' product_name='<?= $item["name"] ?>' spec='<?= $item["spec"] ?>'>加入購物袋</button>
											</div> -->
											<div class="col-xs-12">
												<button name='btn_add' act='2' product_id='<?= $item["id"] ?>' product_name='<?= $item["name"] ?>' spec='<?= $item["spec"] ?>'>立即支持</button>
											</div>
										</div>
<?php endif; ?>										
									</div>
								</div>
							</div>
<?php endforeach; ?>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='modal fade' id='div_cart'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" id='div_modal_header'>
			</div>
			<div class='modal-body'>
				<form id='form_modal' class='vrf'>
					<input type="hidden" name="hid_prod_id">
					<input type="hidden" name="hid_act">
					<input type="hidden" name="hid_source" value='<?= SOURCE_QMAKER ?>'>
					規格
					<select id='sel_modal_spec' name='sel_modal_spec' class="form-control"></select>
					數量
					<input type="number" class="form-control" name="txt_quantity" required></input>
				</form>
			</div>
			<div class='modal-footer' id='div_modal_footer'>
				<button id="btn_addCartConfirm" class="btn btn-primary">加入購物車</button>
			</div>
		</div>
	</div>
</div>

<!--FB-->
<div id="fb-root"></div>

<script type="text/javascript">
$(document).ready(function() {
	//桌機
	window.onload = function(){
		document.getElementById("share_line").onclick = function(){
			window.open('https://lineit.line.me/share/ui?url='+encodeURIComponent(window.location.href),"_blank","toolbar=yes,location=yes,directories=no,status=no, menubar=yes,scrollbars=yes,resizable=no, copyhistory=yes,width=600,height=400")
		}
	}

	$("#details iframe").parent('p').addClass('youtube');
	$("#details img").parent('p').css('text-align','center');

	//FAQ
	$( '.div_faqYes ul li' ).first().addClass('li_arrive').find('.div_answer').slideDown();
	$( '.div_faqYes li' ).click(function() {
		$(this).toggleClass('li_arrive');
		$(this).find('.div_answer').slideToggle();
	});

	$('#btn_like').bind('click',function(){
<?php if(isset($_SESSION['sess_user_id'])): ?>
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'member/favoriteDoCreate',
			data: {
				content_id: $('#hid_projectId').val(),
				source: <?= SOURCE_PROJECT ?>
			},
			statusCode: {
				200: function(e) {
				}
			}
		});
		$(this).toggleClass('btn_arrive');
<?php else: ?>
		alert('請先登入會員！');
<?php endif; ?>
	});


	$('#btn_send').bind('click',function(){
		$.ajax({
			async: false,
			type: 'POST',
			url: $('#hid_baseurl').val() + 'comments/doCreate',
			data: {
				content: $('#txt_content').val(),
				p_id: $('#hid_projectId').val(),
				source: <?= SOURCE_QMAKER ?>
			},
			statusCode: {
				200: function(e) {
					if(e==1) {
						window.location = window.location.href;
					} else {
						alert('送出失敗！');
					}
				}
			}
		});
	});

	$('button[name=btn_add]').bind('click',function() {
<?php if(!isset($_SESSION['sess_user_id'])): ?>
			window.location = $('#hid_baseurl').val() + 'member/login?back=' + $('#hid_baseurl').val() + 'project/view/' + $('#hid_projectId').val();
//			window.location = $('#hid_baseurl').val() + 'project/view/' + $('#hid_projectId').val();
<?php else: ?>
		var str_tmp = '';
		var obj_spec = JSON.parse($(this).attr('spec'));
		for(var key in obj_spec) {
			str_tmp += '<option value="' + key + '">' + obj_spec[key] + '</option>';
		}
		$("#div_modal_header").html('<h2 class="modal-title" >產品名稱：' + $(this).attr('product_name') + '		 ' + $(this).attr('product_id') +'<span id="span_modal_title"></span></h2>');
		$('input[name=hid_prod_id]').val($(this).attr('product_id'));
		$('input[name=hid_act]').val($(this).attr('act'));
		$('input[name=txt_quantity]').val(1);	// for project
		$('#sel_modal_spec').html(str_tmp);
		$('#div_cart').modal('show');
		$('#btn_addCartConfirm').trigger('click');	// for project
<?php endif; ?>
	});

	$('#btn_addCartConfirm').bind('click',function(){
		if(!$('#form_modal')[0].checkValidity()) return;
		$.ajax({
			type: "POST",
			url: $('#hid_baseurl').val() + 'cart/add',
			cache: false,
			async : false,
			data: $('#form_modal').serialize(),
			error: function(xhr){
				alert("Failure");
			},
			complete: function(response){
				switch(response.responseText) {
					case '1':
						$('#div_cart').modal('hide');
						if($('input[name=hid_act]').val().toString() == '1') {
							alert('已加入購物袋');
						} else {
							window.location = '<?= base_url()?>checkout/list';
						}
						break;
				}
			}
		});
		return false;
	});
});

function onclkTabQa() {
	$('li[role=presentation]').removeClass('active');
	$('#li_qa').addClass('active');
}

</script>