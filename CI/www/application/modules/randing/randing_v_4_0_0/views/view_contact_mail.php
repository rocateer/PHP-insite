<!DOCTYPE HTML>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>우성하이테크</title>
</head>

<body style="margin:0; padding:0;">
	<div style="background:#f9f9f9; font:normal 12px; color:#333;">
		<div style="width:700px; margin:0 auto; padding:30px 50px; background:#fff;">
			<h1 style="margin:0 0 40px; padding:0; border-bottom:1px solid #ccc; padding-bottom:20px;"></h1>

			<table cellpadding="15" cellspacing="0" border="0" style="border-top:2px solid #666; border-left:1px solid #ddd; border-right:1px solid #ddd; width:600px; margin:0 auto;">
				<tr>
					<th style="width:100px; background:#f5f5f5; border-bottom:1px solid #ddd;">이름</th>
					<td style="border-bottom:1px solid #ddd;"><?php echo $data['name'];?></td>
				</tr>

				<tr>
					<th style="width:100px; background:#f5f5f5; border-bottom:1px solid #ddd;">이메일</th>
					<td style="border-bottom:1px solid #ddd;"><?php echo $data['email'];?></td>
				</tr>

				<tr>
					<th style="width:100px; background:#f5f5f5; border-bottom:1px solid #ddd;">문의사항</th>
					<td style="border-bottom:1px solid #ddd;"><?php echo $data['message'];?></td>
				</tr>
			</table>

			<div style="height:100px; margin-top:100px; padding:20px 30px 0 30px; background:#f4f4f4;  overflow:hidden;">
				<p style="margin:0 0 8px; padding:0; color:#777;">사이트명 : 우성하이테크  &nbsp;&nbsp;  대표자 : 조현철  &nbsp;&nbsp;   대표번호 : 1566-7247</p>
				<p style="margin:0 0 8px; padding:0; color:#777;">주소 : 경상북도 구미시 산호대로 104-63 &nbsp;&nbsp;  </p>
				<p style="margin:0; padding:0; font-size:11px; color:#777;">본 사이트의 모든 컨텐츠는 저작권법의 보호를 받는바, 무단전재, 복사, 배포 등을 금합니다.</p>
				<p style="margin:10px 0 8px; padding:0; color:#777;">copyright (c) 2016 Woosung High-Tech All Right Resserved</p>
			</div>
		</div>
	</div>
</body>
</html>
