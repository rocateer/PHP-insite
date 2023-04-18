<!doctype html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <title><?=SERVICE_NAME?></title>
    <style>
    </style>
  </head>
  <body style="margin:0;padding:0;max-width: 100%;background-color: #F9F9F9;">
    <div style="width:100%; height:100%; margin: 0 auto; background-color: #F9F9F9;">
      <div style="max-width:600px;width: 100%; height:auto; margin: 0 auto; padding: 30px 20px 60px 20px;box-sizing: border-box;background-color: #F9F9F9;">
        <header>
          <img src="" alt="<?=SERVICE_NAME?>" style="width:110px;">
        </header>
        <p style="font-size:26px; font-weight: bold; font-family: 'NotoSansKR-Bold'; letter-spacing: -1.3px;margin:60px 0 30px 0;">비밀번호 변경</p>
        <div style="background:#fff; border-radius: 10px; padding:40px; box-sizing:border-box;">
          <p style="color:#333;font-family: 'NotoSansKR-Bold'; font-size:16px; font-weight: bold;line-height:26px;margin:0;padding:0">
            신규 비밀번호 <span style="font-size:16px; color:#45C2B1;">*</span>
          </p>
          <input style="border-radius: 0;text-indent: 10px;margin-top:10px; margin-bottom:30px;height:48px; border:1px solid #ddd; width:100%;box-sizing: border-box;" type="text" placeholder="영문,숫자 조합으로 8~15자리로 입력해 주세요">
          <p style="color:#333;font-family: 'NotoSansKR-Bold'; font-size:16px; font-weight: bold;line-height:26px;margin:0;padding:0">
            비밀번호 확인 <span style="font-size:16px; color:#45C2B1;">*</span>
          </p>
          <input style="border-radius: 0;text-indent: 10px;margin-top:10px;height:48px; border:1px solid #ddd; width:100%;box-sizing: border-box;" type="text" placeholder="영문,숫자 조합으로 8~15자리로 입력해 주세요">
          <div style="text-align:center;margin: 0 auto; max-width:260px; margin-top:60px;">
            <a href="/emails_v_1_0_0/password" style="padding: 13px 0; text-decoration: none; display: block; background:#45C2B1;border-radius:10px; color:#fff; text-align:center;">변경</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
