<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<input type="hidden" id="member_addr_postcode" placeholder="우편번호">
<input type="hidden" id="member_addr" placeholder="주소">
<input type="hidden" id="member_region_code" placeholder="시군구 코드">
<input type="hidden" id="member_region_name" placeholder="시군구 이름">
<input type="hidden" id="agent" value="<?=$agent?>"/>
<input type="hidden" id="member_lat" value=""/>
<input type="hidden" id="member_lng" value=""/>
<input type="hidden" id="agent" value="<?=$agent?>"/>

<div id="layer" style="overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch; position:unset;">
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=DAUM_MAP_APPKEY?>&libraries=services"></script>
<script type="text/javascript">

  $(document).ready(function(){
    execDaumPostcode();
  });

  // 다음 주소 API
  function execDaumPostcode() {

      // 우편번호 찾기 화면을 넣을 element
      var element_layer = document.getElementById('layer');

      new daum.Postcode({
          oncomplete: function(data) {
              // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
              // 각 주소의 노출 규칙에 따라 주소를 조합한다.
              // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
              var fullAddr = ''; // 최종 주소 변수
              var extraAddr = ''; // 조합형 주소 변수
              var newAddr = data.roadAddress;
              var roadName = 'R';
              // 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
              if (roadName === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                  fullAddr = data.roadAddress;
              } else { // 사용자가 지번 주소를 선택했을 경우(J)
                  fullAddr = data.jibunAddress;
              }
              // 사용자가 선택한 주소가 도로명 타입일때 조합한다.
              if(roadName === 'R'){
                  //법정동명이 있을 경우 추가한다.
                  if(data.bname !== ''){
                      extraAddr += data.bname;
                  }
                  // 건물명이 있을 경우 추가한다.
                  if(data.buildingName !== ''){
                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                  }
                  // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                  fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
              }
              // 우편번호와 주소 정보를 해당 필드에 넣는다.
              document.getElementById('member_addr_postcode').value = data.zonecode; // 5자리 새우편번호 사용
              document.getElementById('member_addr').value = fullAddr;
              document.getElementById('member_region_code').value = data.sigunguCode; //5자리 새우편번호 사용
              document.getElementById('member_region_name').value = data.sigungu; //5자리 새우편번호 사용

              find_lat_lng(fullAddr); // 좌표 사용할 경우
            //  send_member_addr();

          },
          width:'100%',
      }).embed(element_layer);
      // iframe을 넣은 element를 보이게 한다.
      element_layer.style.display = 'block';
  }

  // 기존 주소를 활용한 위도, 경도 찾기
  function find_lat_lng(fullAddr){
    // 주소-좌표 변환 객체를 생성합니다
        //alert(fullAddr);
    var geocoder = new daum.maps.services.Geocoder();


    // 주소로 좌표를 검색합니다
    geocoder.addressSearch(fullAddr, function(result, status) {
        console.log(result);
        // 정상적으로 검색이 완료됐으면
         if (status === daum.maps.services.Status.OK) {
           document.getElementById('member_lat').value = result[0].y; // 위도
           document.getElementById('member_lng').value = result[0].x; // 경도
           send_member_addr();
        }else{
          alert('잘못된 주소를 입력하셨습니다. 정확한 주소를 입력해주세요.');
        }
    });
  }


  function send_member_addr() {

    var member_addr_postcode = $("#member_addr_postcode").val();
    var member_addr = $("#member_addr").val();
    var member_region_code = $("#member_region_code").val();
    var member_region_name = $("#member_region_name").val();
    var member_lat = $("#member_lat").val();
    var member_lng = $("#member_lng").val();


    if($('#agent').val() == 'android') {

      window.rocateer.addr(member_addr_postcode, member_addr, member_region_code, member_region_name,member_lat,member_lng);

    } else if($('#agent').val() == 'ios') {

      var message = {
                     "member_addr_postcode" : member_addr_postcode,
                     "member_addr" : member_addr,
                     "member_region_code" : member_region_code,
                     "member_region_name" : member_region_name,
                     "member_lat" : member_lat,
                     "member_lng" : member_lng
                    };

      window.webkit.messageHandlers.native.postMessage(message);

    }
  }

</script>
