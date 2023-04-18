<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(UTF-8)</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi"/>
<link rel="stylesheet" type="text/css" href="<?=LIB_WEB_PATH?>/css/import.css"/>
<script type="text/javascript">
//스마트폰 결제 요청
function goPay(form) {
    document.getElementById("vExp").value = getTomorrow();
    document.tranMgr.submit();
    document.charset = "euc-kr";
}
//가상계좌 입금만료일 설정 (today +1)
function getTomorrow(){
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString();
    var dd = (today.getDate()+1).toString();
    if(mm.length < 2){mm = '0' + mm;}
    if(dd.length < 2){dd = '0' + dd;}
    return (yyyy + mm + dd);
}
</script>
</head>
<body>
<form name="tranMgr" method="post" target="_self" action="https://web.nicepay.co.kr/v3/smart/smartPayment.jsp" accept-charset="euc-kr">
  <div class="payfin_area">
    <div class="top">NICEPAY PAY REQUEST(UTF-8)</div>
    <div class="conwrap">
      <div class="con">
        <div class="tabletypea">
          <table>
            <colgroup><col width="30%"/><col width="*"/></colgroup>
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
                <td><input type="text" name="GoodsName" value="<?=$_POST['product_name']?>"></td>
              </tr>
              <tr>
                <th><span>결제 상품개수</span></th>
                <td><input type="text" name="GoodsCnt" value="1"></td>
              </tr>
              <tr>
                <th><span>결제 상품금액</span></th>
                <td><input type="text" name="Amt" value="<?=$_POST['product_price']?>"></td>
              </tr>
              <tr>
                <th><span>구매자명</span></th>
                <td><input type="text" name="BuyerName" value="<?=$_POST['order_name']?>"></td>
              </tr>
              <tr>
                <th><span>구매자 연락처</span></th>
                <td><input type="text" name="BuyerTel" value="<?=$_POST['order_tel']?>"></td>
              </tr>
              <tr>
                <th><span>상품 주문번호</span></th>
                <td><input type="text" name="Moid" value="<?=$_POST['order_number']?>"></td>
              </tr>
              <tr>
                <th><span>상점 아이디</span></th>
                <td><input type="text" name="MID" value="<?=MID?>"></td>
              </tr>

              <!-- 옵션 -->
              <input type="hidden" name="ReturnURL" value="<?=$ReturnURL?>"/>       <!-- Return URL -->
              <input type="hidden" name="CharSet" value="<?=$CharSet?>"/>           <!-- 인코딩 설정 -->
              <input type="hidden" name="GoodsCl" value="1"/>                       <!-- 상품구분 실물(1), 컨텐츠(0) -->
              <input type="hidden" name="VbankExpDate" id="vExp"/>                  <!-- 가상계좌입금만료일 -->
              <input type="hidden" name="BuyerEmail" value="<?=$_POST['order_email']?>"/>     <!-- 구매자 이메일 -->

              <!-- 변경 불가능 -->
              <input type="hidden" name="EncryptData" value="<?=$hashString?>"/>    <!-- 해쉬값 -->
              <input type="hidden" name="ediDate" value="<?=$ediDate?>"/>           <!-- 전문 생성일시 -->
			         <input type="hidden" name="AcsNoIframe" value="Y"/>					<!-- 나이스페이 결제창 프레임 옵션 (변경불가) -->

          </table>
        </div>
      </div>
      <div class="btngroup">
        <a href="#" class="btn_blue" onClick="goPay();">요 청(1004)</a>
      </div>
    </div>
  </div>
</form>
</body>
</html>
