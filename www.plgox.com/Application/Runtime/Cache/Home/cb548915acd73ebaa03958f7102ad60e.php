<?php if (!defined('THINK_PATH')) exit();?>﻿<?php echo W('Common/header');?>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/dl_zc_zh.css">
<style type="text/css">
	.find_mm{
		background:url("/Public/Home/image/findpass.jpg") no-repeat center center;
		
	}




</style>
<!--<div class="header_box1">
		<div class="header_middle">
			<div class="header_middle_left">
				<img src="/Public/Home/image/logo.jpg" />
				
			</div>
			<div class="header_middle_center1" >欢迎注册</div>
			<div style="float:right;width:175px;height:70px;line-height:70px;font-size:16px;text-align:right;">
              已有账号？<a href="<?php echo U('Tourist/login');?>"  style="color:rgb(31,97,195);">立即登录</a>
			</div>
		</div>
</div>-->
	
	
<div class="find_mm">
  <div class="login_box">
  	<div class="find_box1">
      <div  class="find_box1_b">
            <div class="find_box10">
              <div class="find_box101 zhuce_box101">
            用户名：
              </div>    
              <div class="find_box102">
                  <input type="text" name="username" class="username"/>
              </div>
              <div class="find_box10_false"></div>
            </div>
      	<div class="find_box10" >
      	  <div class="find_box101 zhuce_box101">
      	  	手机号码：
      	  </div>	
  
      	  <div class="find_box102" >
      	  	<input type="text" name="tel" class="tel"/>
      	  </div>
      	    <div class="find_box10_false"></div>
      	</div>
      	
      	<div class="find_box10">
      	  <div class="find_box101 zhuce_box101">
      	 图片验证码：
      	  </div>	
      	  <div class="find_box103" style="margin-right:20px;">
      	  	<input type="text" name="imgCode" class="imgCode1"/>
      	  </div>
      	  <div class="YzmCode" style="width:120px;height:40.5px;overflow:hidden;">
      	     <img src="<?php echo U('App/Checkcode/checkcode');?>" style="width:165px;margin-left:-20px;height:50px;overflow:hidden;" alt="" class="find_box105 imageCode">
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	
      	<div class="find_box10">
          <div class="find_box101 zhuce_box101">
            手机验证码：
          </div>  
            <div class="find_box103">
            <input type="text" name="telCode" class="telCode1"/>
            </div>        
          <div class="find_box105 telCode">
             <a href="javascript:void(0);" onclick="get_code();" style="color:#ffffff" class="get_phone_code">获取验证码</a>
          </div>
           <div class="find_box10_false"></div>
        </div>

        
      	<div class="find_box10">
      	  <div class="find_box101 zhuce_box101">
      	 输入密码：
      	  </div>	
      	  <div class="find_box102 password1">
      	  	<input type="text" name="password" class="password" />
      	  	<img class="find_xsmm findmm1"  src="/Public/Home/image/reginster.png" style="cursor:pointer;" onClick="show_pass();"/>
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	
      	<div class="find_box10">
      	  <div class="find_box101 zhuce_box101">
      	确认密码：
      	  </div>	
      	  <div class="find_box102 repassword1">
      	  	<input type="password" name="repassword" class="repassword" />
            <img class="find_xsmm findmm2"  src="/Public/Home/image/findpass1.png" style="cursor:pointer;" onClick="show_repass();"/>
      	  </div>
      	  <div class="find_box10_false"></div>
      	</div>
      	<div class="zhuce_jsxy">
      		<!--<div class="zhuce_jsxy1">
      		  <input type="checkbox" name="jsxy" id="jsxy" />
      		</div>
      		<div class="zhuce_jsxy2">
      		 <span>我已阅读并接受</span>
      		 <span style="color:rgb(207,26,26);cursor:pointer;">《无限魄力用户注册协议》</span>
      		</div>-->
      	</div>
      	<input style="margin-top:58px;" type="button" value="立即注册"  class="find_box106"/>
      </div>
    </div> 
  </div> 
</div>

<div class="zhezhao" style="display:block;">
	<div class="zz_nr"  style="display:block;height:630px;">
		<div class="zz_nr1" style="height:60px;line-height:60px;">无限餐厨注册协议和保密协议</div>	
		<div class="zz_nr2" style="">


        
          <div style="line-height:30px;padding-left:20px;
  padding-right:40px;">
            尊敬的用户欢迎您注册成为本网站会员。请用户仔细阅读以下全部内容。如果用户不同意本服务条款任意内容，请不要注册或使用本网站服务。如用户通过本网站注册程序，即表示用户与本网站已达成协议，自愿接受本服务条款的所有内容。此后，用户不得以未阅读本服务条款内容作任何形式的抗辩。
          </div>
         <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第一条 本站服务条款的确认和接纳</h5>
                <div class="shfw31">1、本网站的各项租赁服务的所有权和运作权归魄力共享所有。您同意所有注册协议条款并完成注册程序，才能成为本站的正式用户。您确认本协议条款是处理双方权利义务的依据，始终有效，法律另有强制性规定或双方另有特别约定的，依其规定或约定。</div>
                <div class="shfw31">2、在您完成注册程序或以其他魄力共享允许的方式实际使用本服务时，您应当是具备完全民事权利能力和完全民事行为能力的自然人、法人或其他组织。您同意并保证您在魄力共享的注册信息真实、准确、有效。魄力共享对您提交的注册信息真实、有效不承担审核责任。</div>
                <div class="shfw31">3、本网站有权了解您使用网站产品及服务的真实背景及目的，有权要求您如实提供真实、全面、准确的信息；如果魄力共享有合理理由怀疑您提供的信息不真实、您进行虚假交易，或您的行为违反魄力网站的网站规则的，魄力共享有权暂时或永久限制您账户下所使用的所有产品及服务的部分或全部功能。</div>
                <div class="shfw31">4、魄力共享保留在中华人民共和国大陆地区施行之法律允许的范围内独自决定拒绝服务、关闭用户账户、清除或编辑内容或取消订单的权利。</div>
                <div class="shfw31">5、您使用本站提供的服务时，应同时接受适用于本站特定服务、活动等的准则、条款和协议（以下统称为“其他条款”）；如果以下使用条件与“其他条款”有不一致之处，则以“其他条款”为准。</div>
                <div class="shfw31">6、 如您连续12个月未使用本网站认可的方式和密码登录过本网站，且您的账户下不存在任何未到期的服务，魄力共享网有权注销您的登录名，您将不能再登录魄力共享网。 </div>
                
              </div>

              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第二条 用户信息</h5>
                <div class="shfw31">1、 用户完成注册申请手续后，获得魄力共享帐号的使用权。用户应提供真实、准确、完整的资料，并不断更新注册信息，符合上述要求。所有原始信息将引用为注册信息。如果因注册信息而引起的问题，并对问题发生所带来的后果，魄力共享不负任何责任。 </div>
                <div class="shfw31">2、 用户不应将其帐号、密码转让、出售或出借予他人使用，如果魄力共享发现使用者并非帐号注册者本人，有权停止继续服务。如用户发现其帐号遭他人非法使用，应立即通知魄力共享。因黑客行为或用户违反本协议规定导致帐号、密码遭他人非法使用的，由用户承担因此导致的损失和一切法律责任，魄力共享不承担任何责任。 </div>
                <div class="shfw31">3、 对于涉及用户注册信息、个人信息等隐私信息的，将对其中涉及个人隐私信息予以严格保密，除非得到您的授权、或法律另有规定外，魄力共享不会向外界披露您的隐私信息。 </div>
                <div class="shfw31">4、 由于法律法规的规定、魄力共享自身必要因素等原因，魄力共享有权登陆进入注册账户，进行证据保全。 并且有权根据您在平台上申请账户时所填写的信息，向魄力共享合作的第三方提取您的相关信息，包括但不限于公证、见证、协助司法机关进行调查取证等。</div>
                <div class="shfw31">5、您同意，魄力共享拥有通过邮件、短信、电话、网站通知或声明等形式，向在本站注册、租赁的用户、收货人发送订单信息、促销活动、售后服务、客户服务等告知信息的权利。如您不希望接收上述信息，可退订。</div>
                <div class="shfw31">6、您不得将在本站注册获得的账号、密码等账户信息提供给他人使用，否则您应承担由此产生的全部责任，并与实际使用人承担连带责任。 </div>
                
              </div>

              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第三条 用户依法言行义务</h5>
                <div class="shfw31">本协议依据国家相关法律法规规章制定，您同意严格遵守以下义务： </div>
                <div class="shfw31">1、不得传输或发表：煽动抗拒、破坏宪法和法律、行政法规实施的言论，煽动颠覆国家政权，推翻社会主义制度的言论，煽动分裂国家、破坏国家统一的言论，煽动民族仇恨、民族歧视、破坏民族团结的言论； </div>
                <div class="shfw31">2、从中国大陆向境外传输资料信息时必须符合中国有关法律法规；</div>
                <div class="shfw31">3、不得利用本站从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动；</div>
                <div class="shfw31">4、不得干扰本站的正常运转，不得侵入本站及国家计算机信息系统；</div>
                <div class="shfw31">5、不得传输或发表任何违法犯罪的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的，淫秽的、不文明的等信息资料；</div>
                <div class="shfw31">8、除本注册协议、服务协议、其他条款或另有其他约定外，您不得利用在本站注册的账户进行经营活动、牟利行为及其他未经本站许可的行为，包括但不限于以下行为：</div>
                <div class="shfw31">7、不得教唆他人从事本条款所禁止的行为；</div>
                <div class="shfw31">8.1您账户内的任何魄力共享优惠信息由魄力共享有解释权和修改权，您仅享有在魄力共享租赁时的使用权，严禁转卖魄力共享账户其他类型的优惠券或利用魄力共享账户进行其他经营性行为等；</div>
                <div class="shfw31">8.2恶意利用技术手段或其他方式，为获取优惠、折扣或其他利益而注册账户、下单等行为，影响其他用户正常消费行为或相关合法权益、影响魄力共享正常秩序的行为；</div>
                <div class="shfw31">8.3发布广告、垃圾邮件；</div>
                <div class="shfw31">8.4以再销售或商业使用为目的对本站商品或服务进行购买的（与魄力共享另有合同约定的除外）；</div>
                <div class="shfw31">8.5本站相关规则、政策、或网页活动规则中限制、禁止的行为；</div>
                <div class="shfw31">8.6其他影响魄力共享对用户账户正常管理秩序的行为。</div>

                <div class="shfw31">9、您不得利用任何非法手段获取其他用户个人信息，不得将其他用户信息用于任何营利或非营利目的，不得泄露其他用户或权利人的个人隐私，否则魄力共享有权采取本协议规定的合理措施制止您的上述行为，情节严重的，将提交公安机关进行刑事立案。</div>
                <div class="shfw31">10、您不得发布任何侵犯他人著作权、商标权等知识产权或其他合法权利的内容；如果有其他用户或权利人发现您发布的信息涉嫌知识产权、或其他合法权益争议的，这些用户或权利人有权要求魄力共享删除您发布的信息，或者采取其他必要措施予以制止，凌雄租赁将会依法采取这些措施。</div>
                <div class="shfw31">11、您应不时关注并遵守本站不时公布或修改的各类规则规定。本站保有删除站内各类不符合法律政策或不真实的信息内容而无须通知您的权利。</div>
                <div class="shfw31">12、若您未遵守以上规定的，本站有权做出独立判断并采取暂停或关闭您的账号、关闭相应交易订单、停止发货等措施。您须对自己在网上的言论和行为承担法律责任。</div>

                
              </div>

                <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第四条 商品信息</h5>
                <div class="shfw31">1、本站上的商品价格、数量、是否有货等商品信息随时都有可能发生变动，本站不作特别通知。由于网站上商品信息的数量极其庞大，虽然本站会尽最大努力保证您所浏览商品信息的准确性，但由于众所周知的互联网技术因素等客观原因存在，本站网页显示的信息可能会有一定的滞后性或差错，对此情形您知悉并理解；魄力共享欢迎提错，将您发现的问题反馈给我们，我们会已最快的速度纠正。 </div>
                <div class="shfw31">2、本站售后服务政策为本协议的组成部分，魄力共享有权以声明、通知或其他形式变更售后服务政策。 </div>
                

                
              </div>


              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第五条 订单</h5>
                <div class="shfw31">1、在您下订单时，请您仔细确认所购商品的名称、价格、数量、型号、规格、尺寸、联系地址、电话、收货人等信息。收货人与您本人不一致的，收货人的行为和意思表示视为您的行为和意思表示，您应对收货人的行为及意思表示的法律后果承担连带责任。</div>
                <div class="shfw31">2、除法律另有强制性规定外，双方约定如下：本站上展示的商品和价格等信息仅仅是交易信息的发布，您下单时须填写您希望购买的商品数量、价款及支付方式、收货人、联系方式、收货地址（合同履行地点）、合同履行方式等内容；系统生成的订单信息是计算机信息系统根据您填写的内容自动生成的数据，仅是您向租赁商发出的合同要约；租赁商收到您的订单信息后，只有在租赁商将您在订单中订购的商品从仓库实际直接向您发出时，方视为您与租赁商之间就实际直接向您发出的商品建立了合同关系；如果您在一份订单里订购了多种商品并且销售商只给您发出了部分商品时，您与租赁商之间仅就实际直接向您发出的商品建立了合同关系；只有在租赁商实际直接向您发出了订单中订购的其他商品时，您和租赁商之间就订单中该其他已实际直接向您发出的商品才成立合同关系。您可以随时登陆您在本站注册的账户，查询您的订单状态。 </div>
                <div class="shfw31">3、尽管租赁商做出最大的努力，但商品目录里的一小部分商品可能会有定价错误。如果发现错误定价，将采取下列之一措施，且不视为违约行为：</div>
                <div class="shfw31">3.1如果某一商品的正确定价低于租赁商的错误定价，租赁商将按照较低的定价向您租赁交付该商品。 </div>

                <div class="shfw31">3.2如果某一商品的正确定价高于租赁商的错误定价，租赁商会通知您，并根据实际情况决定是否取消订单、停止发货、为已付款用户办理退款等。</div>
                <div class="shfw31">4、由于市场变化及各种以合理商业努力难以控制的因素的影响，本站无法保证您提交的订单信息中希望租赁的商品都会有货；如您下单所购买的商品，发生缺货，您有权取消订单，租赁商亦有权取消订单，并为已付款的用户办理退款。 </div>

                

                
              </div>

              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第六条 配送</h5>
                <div class="shfw31">1、租赁商将会把商品（货物）送到您所指定的收货地址，所有在本站上列出的送货时间为参考时间，参考时间的计算是根据库存状况、正常的处理过程和送货时间、送货地点等相关信息估计得出的。</div>
                <div class="shfw31">（1）您提供的信息错误、地址不详细等原因导致的； </div>
                <div class="shfw31">（2）货物送达后无人签收，导致无法配送或延迟配送的；</div>
                <div class="shfw31">（3）情势变更因素导致的； </div>

                <div class="shfw31">（4）未能在本站所示的送货参考时间内送货的；</div>
                <div class="shfw31">（5）因节假日、大型促销活动、店庆、预购或抢购人数众多等原因导致的； </div>
                <div class="shfw31">（6）不可抗力因素导致的，例如：自然灾害、交通戒严、突发战争等。 </div>
               
                

                
              </div>

               <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第七条 所有权及知识产权条款</h5>
                <div class="shfw31">1、您同意并已充分了解本协议的条款，承诺不将已发表于本站的信息，以任何形式发布或授权其他主体以任何方式使用（包括但限于在各类网站、媒体上使用）。</div>
                <div class="shfw31">2、魄力共享网有权不时地对本协议及本站的内容进行修改，并在本站张贴，无须另行通知您。在法律允许的最大限度范围内，魄力共享对本协议及本站内容拥有解释权。</div>
                <div class="shfw31">3、除法律另有强制性规定外，未经魄力共享明确的特别书面许可,任何单位或个人不得以任何方式非法地全部或部分复制、转载、引用、链接、抓取或以其他方式使用本站的信息内容，否则，魄力共享有权追究其法律责任。</div>
                <div class="shfw31">4、本站所刊登的资料信息（包括但不限于文字、图表、商标、logo、标识、按钮图标、图像、声音文件片段、数字下载、数据编辑和软件等），均是魄力共享或其内容提供者的财产，受中国和国际相关版权法规、公约等的保护，未经魄力共享书面许可，任何第三方无权将上述资料信息复制、出版、发行、公开展示、编码、翻译、传输或散布至任何其他计算机、服务器、网站或其他媒介。本站上所有内容的汇编是魄力共享的排他财产，受中国和国际版权法的保护。本站上所有设备都是魄力共享或其关联公司或其设备供应商的财产，受中国和国际版权法的保护。您不得鼓励、协助或授权任何其他人复制、修改、反向工程、拆解或者试图篡改全部或部分设备。</div>

              </div>


              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第八条 责任限制及不承诺担保</h5>
                <div class="shfw31">1、除非另有明确的书面说明,本站及其所包含的或以其他方式通过本站提供给您的全部信息、内容、材料、产品和服务，均是在“按现状”和“按现有”的基础上提供的。</div>
                <div class="shfw31">2、除非另有明确的书面说明,魄力共享不对本站的运营及其包含在本站上的信息、内容、材料、产品或服务作任何形式的、明示或默示的声明或担保（根据中华人民共和国法律另有规定的以外）。 </div>
                <div class="shfw31">3、魄力共享不担保本站所包含的或以其他方式通过本站提供给您的全部信息、内容、材料、产品和服务、其服务器或从本站发出的电子信件、信息没有病毒或其他有害成分。</div>
                <div class="shfw31">4、如因不可抗力或其他本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，魄力共享会合理地尽力协助处理善后事宜。</div>

                <div class="shfw31">5、您应对账户信息及密码承担保密责任，因您未能尽到信息安全和保密责任而致使您的账户发生任何问题的，您应承担全部责任。同时，因网络环境存在众多不可预知因素，因您自身终端网络原因（包括但不限于断网、黑客攻击、病毒等）造成您的魄力共享账户或个人信息等被第三方窃取的，魄力共享不承担赔偿责任。</div>
                <div class="shfw31">（5）因节假日、大型促销活动、店庆、预购或抢购人数众多等原因导致的； </div>
                <div class="shfw31">6、您了解并同意，魄力共享有权应国家有关机关的要求，向其提供您在魄力共享的用户信息和交易记录等必要信息。如您涉嫌侵犯他人合法权益，则魄力共享有权在初步判断涉嫌侵权行为可能存在的情况下，向权利人提供您必要的个人信息。</div>
               
                

                
              </div>



              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第九条 协议更新及用户关注义务</h5>
                <div class="shfw31">根据国家法律法规变化及网站运营需要，魄力共享有权对本协议条款不时地进行修改，修改后的协议一旦被张贴在本站上即生效，并代替原来的协议。您可随时登陆查阅最新协议；您有义务不时关注并阅读最新版的协议、其他条款及网站公告。如您不同意更新后的协议，可以且应立即停止接受魄力共享网站依据本协议提供的服务；如您继续使用本站提供的服务的，即视为同意更新后的协议。魄力共享建议您在使用本站之前阅读本协议及本站的公告。如果本协议中任何一条被视为废止、无效或因任何理由不可执行，该条应视为可分的且并不影响任何其余条款的有效性和可执行性。</div>
                
                

                
              </div>

              <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第十条 法律管辖和适用</h5>
                <div class="shfw31">本协议的订立、执行和解释及争议的解决均适用在中华人民共和国大陆地区适用之有效法律（但不包括其冲突法规则）。如发生本协议与适用之法律相抵触时，则这些条款将完全按法律规定重新解释，而其他条款继续有效。如缔约方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向有管辖权的中华人民共和国大陆地区法院提起诉讼。</div>
                
                

                
              </div>


               <div class="shfw3" style="margin-top:15px;">
                <h5 style="font-weight:900;">第十一条 其他</h5>
                <div class="shfw31">1、魄力共享网站所有者是指在政府部门依法许可或备案的魄力共享网站经营主体。</div>
                 <div class="shfw31">2、魄力共享尊重您的合法权利，本协议及本站上发布的各类规则、声明、售后服务政策等其他内容，均是为了更好的、更加便利的为您提供服务。本站欢迎您和社会各界提出意见和建议，魄力共享将虚心接受并适时修改本协议及本站上的各类规则。</div>
                 <div class="shfw31">3、您勾选“我已阅读并同意《魄力共享用户注册协议》”前的按钮即视为您完全接受本协议，在点击之前请您再次确认已知悉并完全理解本协议的全部内容。</div>
                
                

                
              </div>




		</div>
		<div class="zz_nr3">
			<a href="<?php echo U('Index/index');?>">取消</a>
			<a href="#" class="tyjs">同意并继续</a>	
		</div>
		<br/>	  <br/>   <br/> 
	</div>		
</div>

<script type="text/javascript">
	
$(".tyjs").click(function(){
	$(".zhezhao").css("display","none");
});
	
	
function show_pass() {
	if($(".password").attr("type")=="password"){
		$(".password").attr("type","text");
		$(".findmm1").attr("src","/Public/Home/image/reginster.png");
	}
	else{
		$(".password").attr("type","password");
		$(".findmm1").attr("src","/Public/Home/image/findpass1.png");
	}
}

function show_repass() {
    if($(".repassword").attr("type")=="password"){
		$(".repassword").attr("type","text");
		$(".findmm2").attr("src","/Public/Home/image/reginster.png");
	}
	else{
		$(".repassword").attr("type","password");
		$(".findmm2").attr("src","/Public/Home/image/findpass1.png");
	}
}


//进入焦点提醒



// 验证码
$(function(){
      var time = new Date().getTime();
      $(".imageCode").click(function(){
            $(this).attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzm=" + time );
      });
      
     function gxtx(){
     	var time = new Date().getTime();
        $(".imageCode").attr("src","<?php echo U('App/Checkcode/checkcode');?>?yzm="+time );
        return false;
     }
     
      var jgj=""; 
       function yhm(){
            var fontCheck = /^[a-zA-Z0-9_]+$/;
            if(!fontCheck.test( $(".username").val())){
              $(".find_box10_false").eq(0).html("支持英文字母、阿拉伯数字及下划线“_”构成");
              $(".username").css("border","1px solid #cf1a1a");
              jgj="false";
             
            }
            else if($(".username").val().length>20){
                $(".find_box10_false").eq(0).html("用户名为6-20个字符");
                $(".username").css("border","1px solid #cf1a1a");
               jgj="false";
            }
            else if($(".username").val().length<6){
                $(".find_box10_false").eq(0).html("用户名为6-20个字符");
                $(".username").css("border","1px solid #cf1a1a");
               jgj="false";
            }
            else{
              $(".find_box10_false").eq(0).html("");
              $(".username").css("border","1px solid #D6D6D6");
              jgj="true";
            }
          }

    function sjh(){
           var re = /^[1][3,4,5,7,8][0-9]{9}$/;
            if( !re.test($(".tel").val()) || $(".tel").val()==""){
             // alert("请输入正确的手机号码");
              $(".find_box10_false").eq(1).html("请输入正确的手机号码");
              $(".tel").css("border","1px solid #cf1a1a");
              jgj="false";
            }
            else{
              $(".find_box10_false").eq(1).html("");
              $(".tel").css("border","1px solid #D6D6D6");
              jgj="true";
            }
          }

          function sjyz(){
          if( $(".telCode1").val() == "" ){
            $(".find_box10_false").eq(3).html("手机验证码错误!");
            jgj="false";
            $(".telCode1").css("border","1px solid #cf1a1a");
          }
          else{
            $(".find_box10_false").eq(3).html("");
            $(".telCode1").css("border","1px solid #D6D6D6");
            jgj="true";
          }
        }

        function tpyz(){
           if($(".imgCode1").val() =="" ){
              $(".find_box10_false").eq(2).html("请输入正确的图形验证码");
              $(".imgCode1").css("border","1px solid #cf1a1a");
              jgj="false";
            
            }
            else{
              $(".find_box10_false").eq(2).html("");
              $(".imgCode1").css("border","1px solid #D6D6D6");
               jgj="true"; 
               
            }
        }


        function mm(){
           if( $(".password").val() == "" ){
              $(".find_box10_false").eq(4).html("密码不能为空!");
              $(".password").css("border","1px solid #cf1a1a");
             jgj="false";
            }
            else{
              $(".find_box10_false").eq(4).html("");
              $(".password").css("border","1px solid #D6D6D6");
              jgj="true";
            }
        }

        function zcmm(){
          if($(".repassword").val()==""){
               $(".find_box10_false").eq(5).html("确认密码不能为空");
                $(".repassword").css("border","1px solid #cf1a1a");
               jgj="false";
          }
            else if( $(".password").val() !== $(".repassword").val()  ){
              //alert("两次输入的密码不一致，请重新输入!");
               $(".find_box10_false").eq(5).html("两次输入的密码不一致，请重新输入!");
                $(".repassword").css("border","1px solid #cf1a1a");
               jgj="false";
            }
            else{
              $(".find_box10_false").eq(5).html("");
              $(".repassword").css("border","1px solid #D6D6D6");
               jgj="true";
            }
       }
 
 $("input").each(function(index){
  $(this).focus(function(){
    $(".find_box10_false").eq(index).css("color","#CCCCCC");
     if(index==0){
      $(".find_box10_false").eq(index).html("用户帐号只能由英文字母、阿拉伯数字及下划线“_”构成");
         
     }
     else if(index==1){
       $(".find_box10_false").eq(index).html("手机号码如：13099073632");

     }
     else if(index==2){
     	$(".find_box10_false").eq(index).html("请输入正确的图形验证码");
       
     }
     else if(index==3){
       $(".find_box10_false").eq(index).html("请输入正确的手机验证码");
     }
     else if(index==4){
       $(".find_box10_false").eq(index).html("有被盗风险,建议使用字母、数字和符号两种及以上组合");
     }
     else if(index==5){
       $(".find_box10_false").eq(index).html("必须与上面的密码一致");
     }
  });
  
  $(this).blur(function(){
       $(".find_box10_false").eq(index).css("color","#CF1A1A"); 
      if(index==0){
           yhm();
     }
     else if(index==1){
          sjh();
     }
     else if(index==2){
        tpyz();
     }
     else if(index==3){
         
         sjyz();
     }
     else if(index==4){
         mm();
     }
     else if(index==5){
        zcmm();
     }

   });
});


      // 注册
     $(".find_box106").on("click",function(){
                yhm();
                sjh();
                tpyz();
                sjyz();              
                mm();
                zcmm();
		
	  /*if(!$('#jsxy').is(':checked')){
		alert("请阅读无限魄力网络协议");
	  }*/
	  
      
      
    if(jgj=="true"){
         $.ajax({
            type: "POST",
            dataType: "JSON",
            //,"imgCode":$(".imgCode1").val()
            url: "<?php echo U('Tourist/doregister');?>",
            data: { "username":$(".username").val() , "tel":$(".tel").val() , "password":$(".password").val() , "telCode":$(".telCode1").val()  },
            success: function( data ){
               if( data.status == 200 ){
                  alert(data.message);
                  window.location.href="<?php echo U('Tourist/login');?>";
                  return false;
               }else if( data.status == 201 ){
                  alert(data.message);
                  console.log(data.message+"0");
                  gxtx();
               }else if( data.status ==203 ){
                  $(".find_box10_false").eq(3).html(data.message);
                  $(".telCode1").css("border","1px solid #cf1a1a");
                  gxtx();
               }else if( data.status == 204 ){
                  alert(data.message);
                  console.log(data.message+"2");
                  gxtx();
               }/*else if( data.status == "-2001" ){
               	console.log(data.message+"3");
                  $(".find_box10_false").eq(2).html(data.message);
                  $(".imgCode1").css("border","1px solid #cf1a1a");
                  gxtx();
               }*/
            }
        }); 
      }


    });
});
// 手机验证码
function get_code(){
if( $(".username").val() == ""){
  $(".find_box10_false").eq(0).html("请输入注册用户名!");
  $(".username").css("border","1px solid #cf1a1a");        
             
}
var re = /^[1][3,4,5,7,8][0-9]{9}$/;
if( !re.test($(".tel").val()) ){
  $(".find_box10_false").eq(1).html("请输入正确的手机号码");
  $(".tel").css("border","1px solid #cf1a1a");
  return false;
}
if( $(".imgCode1").val() == "" ){
  $(".find_box10_false").eq(2).html("请输入图形验证码!");
   $(".imgCode1").css("border","1px solid #cf1a1a");
   return false;
}
  $.ajax({
      type: "post",
      dataType: "json",
      url: "<?php echo U('Tourist/send_code');?>",
      data: { username:$(".username").val() , tel:$(".tel").val() , imgCode:$(".imgCode1").val() },
      success: function( data ){
          if( data.status == 200 ){
              alert(data.message);
              console.log(data.message);
              timess = 120;
              times = self.setInterval("code_Count_down()",1000);
              return false;
          }else if( data.status ==202 ){
              alert(data.message);
              console.log(data.message+"===");
              gxtx();
          }else if( data.status == 201 ){
             $(".find_box10_false").eq(2).html(data.message);
              gxtx();
          }
      }
  });
}
var timess;
function code_Count_down(){
  $(".telCode").html("<a class='get_phone_code' style='color:#ffffff'>剩余("+timess+")秒</a>");
  timess--;
  if( timess < 0 ){
    clearInterval(times);
    times=0;
    $(".telCode").html("<a class='get_phone_code' onclick='get_code()' style='color:#ffffff'>获取验证码</a>");
  }
}

 $(".header_bottom1_middle li").eq(0).removeClass("header_dj");
 $(".mfzc").css("border-bottom","3px solid #1f61c3");
</script>
<?php echo W('Common/footer');?>