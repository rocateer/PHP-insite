<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <title><?=SERVICE_NAME?></title>
    <style>
    </style>
  </head>
  <body style="margin:0;padding:0;max-width: 100%;background-color: #F9F9F9;">
    <div style="width:100%; height:100%;min-height: calc(100vh - 410px); margin: 0 auto;background-color: #F9F9F9;">
      <div style="max-width:600px; height:auto; margin: 0 auto; padding: 30px 20px 60px 20px; box-sizing: border-box;background-color: #F9F9F9;">
        <header>
          <img src="http://m.evescore.com/images/logo_login.png" alt="<?=SERVICE_NAME?>" style="width:100px;">
        </header>
        <p style="font-size:24px; font-weight: bold; font-family: 'NotoSansKR-Bold'; letter-spacing: -1.3px; margin:60px 0 30px 0; text-align:center;"><?=SERVICE_NAME?> 비밀번호 변경</p>
        <div style="background:#fff; border-radius: 10px; padding:40px; box-sizing:border-box;">
          <p style="letter-spacing: -0.5px;color:#333; font-size:14px; line-height:26px;margin:0;padding:0; text-align:center;">
            비밀번호 변경을 위해 아래 링크로 이동하여 주세요.</p>
          <div style="text-align:center;margin: 0 auto; max-width:260px; margin-top:60px;">
            <a href="http://pw.evescore.com/find_pw_to_email/member_pw_change_key_check?p_code=<?=$data['change_pw_key']?>" style="padding:13px 0; text-decoration: none; display: block; background:#4C35CA; border-radius:24px; color:#fff; text-align:center; font-size:16px; font-weight:bold;">링크로 이동</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
