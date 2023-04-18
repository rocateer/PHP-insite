<?php
  /**
  * 팜빌 팩스 API PHP SDK Example
  *
  * PHP SDK 연동환경 설정방법 안내 : blog.linkhub.co.kr/584
  * 업테이트 일자 : 2018-07-03
  * 연동기술지원 연락처 : 1600-9854 / 070-4304-2991
  * 연동기술지원 이메일 : code@linkhub.co.kr
  *
  * <테스트 연동개발 준비사항>
  * 1) 19, 22번 라인에 선언된 링크아이디(LinkID)와 비밀키(SecretKey)를
  *    링크허브 가입시 메일로 발급받은 인증정보를 참조하여 변경합니다.
  * 2) 팝빌 개발용 사이트(test.popbill.com)에 연동회원으로 가입합니다.
  */

  require_once '../Popbill/PopbillMessaging.php';

  // 링크아이디
  $LinkID = 'TESTER';

  // 비밀키
  $SecretKey = 'SwWxqU+0TErBXy/9TVjIPEnI0VTUMMSQZtJf3Ed8q3I=';

  //통신방식 기본은 CURL , curl 사용에 문제가 있을경우 STREAM 사용가능.
  //STREAM 사용시에는 allow_fopen_url = on 으로 설정해야함.
  define('LINKHUB_COMM_MODE','CURL');

  $MessagingService = new MessagingService($LinkID, $SecretKey);

  // 연동환경 설정값, 개발용(true), 상업용(false)
  $MessagingService->IsTest(true);

?>
