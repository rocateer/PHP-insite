
<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(UTF-8)</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi" />
<link rel="stylesheet" type="text/css" href="<?=LIB_WEB_PATH?>/css/import.css"/>
<script src="https://web.nicepay.co.kr/v3/webstd/js/nicepay-2.0.js" type="text/javascript"></script>
<script type="text/javascript">
//결제창 최초 요청시 실행됩니다.
function nicepayStart(){
    goPay(document.payForm);
}

//결제 최종 요청시 실행됩니다. <<'nicepaySubmit()' 이름 수정 불가능>>
function nicepaySubmit(){
    document.payForm.submit();
}

//결제창 종료 함수 <<'nicepayClose()' 이름 수정 불가능>>
function nicepayClose(){
    alert("결제가 취소 되었습니다");
}
</script>
</head>
<body>
<form name="payForm" method="post" action="/pg_nice/pg_end">
    <div class="payfin_area">
      <div class="top">NICEPAY PAY REQUEST(UTF-8)</div>
      <div class="conwrap">
        <div class="con">
          <div class="tabletypea">
            <table>
              <colgroup><col width="30%" /><col width="*" /></colgroup>
              <tr>
                <th><span>결제 수단</span></th>
                <td>
                  <select name="PayMethod">
                    <option value="CARD">신용카드</option>
                    <option value="BANK">계좌이체</option>
                    <option value="CELLPHONE">휴대폰결제</option>
                    <option value="VBANK">가상계좌</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th><span>결제 상품명</span></th>
                <td><input type="text" name="GoodsName" value="<?php echo($nicepay->m_GoodsName);?>"></td>
              </tr>
              <tr>
                <th><span>결제 상품개수</span></th>
                <td><input type="text" name="GoodsCnt" value="1"></td>
              </tr>
              <tr>
                <th><span>결제 상품금액</span></th>
                <td><input type="text" name="Amt" value="<?php echo($nicepay->m_Price);?>"></td>
              </tr>
              <tr>
                <th><span>구매자명</span></th>
                <td><input type="text" name="BuyerName" value="<?php echo($nicepay->m_BuyerName);?>"></td>
              </tr>
              <tr>
                <th><span>구매자 연락처</span></th>
                <td><input type="text" name="BuyerTel" value="<?php echo($nicepay->m_BuyerTel);?>"></td>
              </tr>
              <tr>
                <th><span>상품 주문번호</span></th>
                <td><input type="text" name="Moid" value="<?php echo($nicepay->m_Moid);?>"></td>
              </tr>
              <tr>
                <th><span>상점 아이디</span></th>
                <td><input type="text" name="MID" value="<?php echo($nicepay->m_MID);?>"></td>
              </tr>

              <!-- IP -->
              <input type="hidden" name="UserIP" value="<?php echo($nicepay->m_UserIp);?>"/>                    <!-- 회원사고객IP -->

              <!-- 옵션 -->
              <input type="hidden" name="VbankExpDate" value="<?php echo($nicepay->m_VBankExpDate); ?>"/>       <!-- 가상계좌입금만료일 -->
              <input type="hidden" name="BuyerEmail" value="<?php echo($nicepay->m_BuyerEmail); ?>"/>           <!-- 구매자 이메일 -->
              <input type="hidden" name="TransType" value="0"/>                                                 <!-- 일반(0)/에스크로(1) 선택 파라미터 -->
              <input type="hidden" name="GoodsCl" value="1"/>                                                   <!--실물(1) 컨텐츠(0) -->

              <!-- 변경 불가능 -->
              <input type="hidden" name="EdiDate" value="<?php echo($nicepay->m_EdiDate); ?>"/>                 <!-- 전문 생성일시 -->
              <input type="hidden" name="EncryptData" value="<?=$hashString?>"/>                               <!-- 해쉬값	-->
              <input type="hidden" name="TrKey" value=""/>                                                      <!-- 필드만 필요 -->
            </table>
          </div>
        </div>
        <div class="btngroup">
          <a href="#" class="btn_blue" onClick="nicepayStart();">요 청</a>
        </div>
      </div>
    </div>
</form>
</body>
</html>
