<?
    /* ============================================================================== */
    /* =   PAGE : 인증 요청 PAGE                                                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2012.01   KCP Inc.   All Rights Reserved.                 = */
    /* ============================================================================== */

    /* ============================================================================== */
    /* =   Hash 데이터 생성 필요 데이터                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* = 사이트코드 ( up_hash 생성시 필요 )                                         = */
    /* = -------------------------------------------------------------------------- = */
    //setlocale(LC_CTYPE, 'ko_KR.euc-kr');
    //header("Content-Type: text/html; charset=UTF-8");
    // $site_cd   = "S6186";
    $site_cd   = "A7Q3F"; // 계약후 발급한 사이트코드

    /* = -------------------------------------------------------------------------- = */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
        <meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, target-densitydpi=medium-dpi" >
        <title>*** KCP Online Certification System [PHP Version] ***</title>

        <script type="text/javascript">

            // 결제창 종료후 인증데이터 리턴 함수
            function auth_data( frm )
            {
                var auth_form     = document.form_auth;
                var nField        = frm.elements.length;
                var response_data = "";

                // up_hash 검증
                if( frm.up_hash.value != auth_form.veri_up_hash.value )
                {
                    alert("up_hash 변조 위험있음");

                }


                //스마트폰 처리
                for ( i = 0; i < nField; i++ )
                {
                    if( frm.elements[i].value != "" )
                    {
                        response_data += frm.elements[i].name + " : " + frm.elements[i].value + "\n";
                    }
                }

                if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
                {
                    document.getElementById( "cert_info" ).style.display = "";
                    document.getElementById( "kcp_cert"  ).style.display = "none";
                }

                alert(response_data);
            }

            // 인증창 호출 함수
            function auth_type_check()
            {
                var auth_form = document.form_auth;

                if( auth_form.ordr_idxx.value == "" )
                {
                    alert( "주문번호는 필수 입니다." );

                    return false;
                }
                else
                {
                    if( navigator.userAgent.indexOf("Android") > - 1 || navigator.userAgent.indexOf("iPhone") > - 1 )
                    {
                        auth_form.target = "kcp_cert";

                        document.getElementById( "cert_info" ).style.display = "none";
                        document.getElementById( "kcp_cert"  ).style.display = "";
                        alert('mobile');
                    }
                    else
                    {
                        var return_gubun;
                        var width  = 410;
                        var height = 500;

                        var leftpos = screen.width  / 2 - ( width  / 2 );
                        var toppos  = screen.height / 2 - ( height / 2 );

                        var winopts  = "width=" + width   + ", height=" + height + ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
                        var position = ",left=" + leftpos + ", top="    + toppos;
                        var AUTH_POP = window.open('','auth_popup', winopts + position);

                        auth_form.target = "auth_popup";
                        alert('pc');
                    }

                    // 추가된 부분: 모바일에서만 인증하기 때문에 무조건 kcp_cert를 태운다.
                    // auth_form.target = "kcp_cert";
                    // document.getElementById( "cert_info" ).style.display = "none";
                    // document.getElementById( "kcp_cert"  ).style.display = "";


                    // auth_form.target = "auth_popup";
                    // alert('last');
                    // auth_form.target = "kcp_cert";
                    auth_form.action = "/kcp_cert/smartcert_proc_req"; // 인증창 호출 및 결과값 리턴 페이지 주소


                    // return true;
                }
            }

            /* 예제 */
            window.onload=function()
            {
                var today            = new Date();
                var year             = today.getFullYear();
                var month            = today.getMonth() + 1;
                var date             = today.getDate();
                var time             = today.getTime();
                var year_select_box  = "<option value=''>선택 (년)</option>";
                var month_select_box = "<option value=''>선택 (월)</option>";
                var day_select_box   = "<option value=''>선택 (일)</option>";

                if(parseInt(month) < 10) {
                    month = "0" + month;
                }

                if(parseInt(date) < 10) {
                    date = "0" + date;
                }

                year_select_box = "<select name='year' class='frmselect' id='year_select'>";
                year_select_box += "<option value=''>선택 (년)</option>";

                for(i=year;i>(year-100);i--)
                {
                    year_select_box += "<option value='" + i + "'>" + i + " 년</option>";
                }

                year_select_box  += "</select>";
                month_select_box  = "<select name=\"month\" class=\"frmselect\" id=\"month_select\">";
                month_select_box += "<option value=''>선택 (월)</option>";

                for(i=1;i<13;i++)
                {
                    if(i < 10)
                    {
                        month_select_box += "<option value='0" + i + "'>" + i + " 월</option>";
                    }
                    else
                    {
                        month_select_box += "<option value='" + i + "'>" + i + " 월</option>";
                    }
                }

                month_select_box += "</select>";
                day_select_box    = "<select name=\"day\"   class=\"frmselect\" id=\"day_select\"  >";
                day_select_box   += "<option value=''>선택 (일)</option>";
                for(i=1;i<32;i++)
                {
                    if(i < 10)
                    {
                        day_select_box += "<option value='0" + i + "'>" + i + " 일</option>";
                    }
                    else
                    {
                        day_select_box += "<option value='" + i + "'>" + i + " 일</option>";
                    }
                }

                day_select_box += "</select>";

                document.getElementById( "year_month_day"  ).innerHTML = year_select_box + month_select_box + day_select_box;

                init_orderid(); // 주문번호 샘플 생성

            }

            // 주문번호 생성 예제 ( up_hash 생성시 필요 )
            function init_orderid()
            {
                var today = new Date();
                var year  = today.getFullYear();
                var month = today.getMonth()+ 1;
                var date  = today.getDate();
                var time  = today.getTime();

                if(parseInt(month) < 10)
                {
                    month = "0" + month;
                }

                var vOrderID = year + "" + month + "" + date + "" + time;

                document.form_auth.ordr_idxx.value = vOrderID;

            }

            // submit 버튼 없이 바로 인증창 띄우기
            $(document).ready(function(){
              // init_orderid();
              // auth_type_check();
              // document.form_auth.submit();
              $("#form_auth").submit();
              // window.self.close();
            });

        </script>
        <style type="text/css">

        	body{
        		font-family:나눔고딕, 돋움, Tahoma, Geneva, sans-serif;
        		font-size:13px;
        		padding:0;
        		margin:0;
        		background: #fff;}

        		a{text-decoration:none;}
        		a:link		{color:#000; cursor:pointer;}
        		a:visited 	{color:#000; cursor:pointer;}
        		a:hover		{color:#c8c8c8; cursor:pointer;}
        		a:active	{color:#000; cursor:pointer;}

        	.TitleBar{font-size:17px; color:#000; font-weight:bold;}

        	@-webkit-keyframes zoom {
        	 from { opacity: 0.1; font-size: 100%;}
        	 to {
        	   opacity: 1.0;
        	   font-size: 130%;
        	 }
        	}

        	.selectBar{margin:10px;	}
          .selectBar label{font-size:12px; padding:3px; color:#999; display: block;}
        	.selectBar label span{font-size:12px; font-weight: bold; color:#ed1746; }
        	.selectBar span{font-size:14px;	padding:3px;}
        	.selectBar input{font-family: 나눔고딕, Tahoma, Geneva, sans-serif;	font-size:14px;	padding:6px; margin:0px; text-align:left; background:#fff; width:90%;
          border-bottom:1px solid #fff; border-top:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #fff; height:40px;}
        	.selectBar .listInput{width:90px;	text-align:left;}
        	.selectBar .largeInput{	width:95%;	text-align:left;}
        	.selectBar select{width:140px; font-size:15px;}
        	.selectList ul{	list-style:none; margin:0px; padding:0;}
        	.selectList ul li{position: relative; padding:10px 0 0 0px; margin: 0; border-bottom:1px solid #ccc; display: block;}
          .selectList ul li .r_txt{position: absolute; right:10px; bottom:10px;}
          .selectList ul li select{border:1px solid #ccc; border-radius:3px; font-size:12px; height:30px; width:25%; margin-right: 3px;}
          .selectList ul li .radio_input{display:inline-block; width:15px; vertical-align: middle; margin-left: 5px;}

          .btn_red{background:#ed1746; color:#fff; border: none; width:100%; display: block; padding:12px; font-size: 14px; text-align: center;}
        </style>
    </head>
    <body oncontextmenu="return false;" ondragstart="return false;" onselectstart="return false;" style="display:none;" >
        <div id="cert_info">
            <!-- <form name="form_auth" id="form_auth" method="post" accept-charset="UTF-8" action="/kcp_cert/smartcert_proc_req"> -->
              <form name="form_auth" id="form_auth" method="post" accept-charset="UTF-8" action="/kcp_cert_web_view/smartcert_proc_req">
              <!-- new ui : s -->
              <div class="selectList" style="margin-top:20px;">
                <ul>
            			<li class="selectBar">
            				<label>주문 번호</label>
            				<input type="text" name="ordr_idxx" class="frminput" value="1234"  readonly="readonly"/>
            			</li>
                  <li class="selectBar">
            				<label>성명</label>
            				<input type="text" name="user_name" value="" size="20" maxlength="20" class="frminput" />
            			</li>
                  <li class="selectBar">
            				<label>생년월일</label>
            				<p id="year_month_day"></p>
            			</li>
                  <li class="selectBar">
            				<label>성별구분</label>
                    <div style="display:block; ">
                      <input type="radio" name="sex_code" value="01" class="radio_input" /> 남성
                      <input type="radio" name="sex_code" value="02" class="radio_input" /> 여성
                      <select name='local_code' class="frmselect" style="width:80px;">
                          <option value=''>선택</option>
                          <option value='01'>내국인</option>
                          <option value='02'>외국인</option>
                      </select>
                    </div>
                    <!-- 내/외국인구분 -->
            			</li>
            		</ul>
              </div>
              <div style="padding:20px 10px;">
                <input type="image" onclick="return auth_type_check();" class="btn_red" alt="결제를 요청합니다" />
              </div>
              <!-- new ui : e -->

                <!-- 요청종류 -->
                <input type="hidden" name="req_tx"       value="cert"/>
                <!-- 요청구분 -->
                <input type="hidden" name="cert_method"  value="01"/>
                <!-- 웹사이트아이디 -->

                <!-- 계약할때 준 아이디 -->
                <!-- <input type="hidden" name="web_siteid"   value="J17090501839"/> -->
                <input type="hidden" name="web_siteid"   value=""/>

                <!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요
                     SKT : SKT , KT : KTF , LGU+ : LGT
                <input type="hidden" name="fix_commid"      value="KTF"/>
                -->
                <!-- 사이트코드 -->
                <input type="hidden" name="site_cd"      value="<?= $site_cd ?>" />
                <!-- Ret_URL : 인증결과 리턴 페이지 ( 가맹점 URL 로 설정해 주셔야 합니다. ) -->
                <!-- <input type="hidden" name="Ret_URL"      value="http://freeway.kcp.co.kr/pgsample/USER/lds/linux-php/kcpcert_enc/SMART_ENC/smartcert_proc_req.php" /> -->
                <input type="hidden" name="Ret_URL"      value="<?=THIS_DOMAIN?>/kcp_cert_web_view/smartcert_proc_res" />

                <!-- cert_otp_use 필수 ( 메뉴얼 참고)
                     Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
                -->
                <input type="hidden" name="cert_otp_use" value="Y"/>
                <!-- cert_enc_use 필수 (고정값 : 메뉴얼 참고) -->
                <input type="hidden" name="cert_enc_use" value="Y"/>

				<!-- cert_able_yn input 비활성화 설정 -->
                <input type="hidden" name="cert_able_yn" value=""/>

                <input type="hidden" name="res_cd"       value=""/>
                <input type="hidden" name="res_msg"      value=""/>

                <!-- up_hash 검증 을 위한 필드 -->
                <input type="hidden" name="veri_up_hash" value=""/>

                <!-- web_siteid 을 위한 필드 -->
                <input type="hidden" name="web_siteid_hashYN" value="Y"/>

                <!-- 가맹점 사용 필드 (인증완료시 리턴)-->
                <input type="hidden" name="param_opt_1"  value="opt1"/>
                <input type="hidden" name="param_opt_2"  value="opt2"/>
                <input type="hidden" name="param_opt_3"  value="opt3"/>
            </form>
        </div>
        <iframe id="kcp_cert" name="kcp_cert" width="100%" height="700" frameborder="0" scrolling="no" style="display:none"></iframe>
    </body>

</html>
