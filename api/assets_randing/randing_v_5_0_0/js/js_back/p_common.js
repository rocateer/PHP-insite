//시간 차이함수
function get_hourDiff(sdate,edate){

 var startDate = new Date(2009,07,31,13,00,00);
 var endDate  = new Date(2009,07,31,14,00,00);
 var tmp = (endDate.getTime() - startDate.getTime()) / 3600000;
 return tmp;

}
$(function(){
	//숫자만 입력
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
});
//파일 삭제 처리
function do_file_delete(file,fr,div,idx,val){

	if(confirm("정말로 파일을 삭제 하시겠습니까?")){
		$.ajax({
			url:'/commonLib/file/file_delete_xt.html',
			type:'post',
			data:"mode=FILE_DELETE&del_file="+file+"&fr="+fr+"&div="+div+"&idx="+idx+"&val="+val,
			dataType: "json",
			error: function(xhr, status, errorThrown){
				alert("1."+errorThrown+"\n2."+status+"\n3."+xhr.statusText+'\n4.'+xhr.status );
			},
			success:function(data){
				//console.log(data);
				if(data !=null){
					switch(data['RETURNCODE']){
								case "Y" : alert("삭제 되었습니다."); $("#img_"+div).css("display","none"); $("#btn_"+div).css("display","none");	return;
								case "N" : alert("삭제실패"); return;
								case "E" : alert("파일이 없습니다."); return;
								case "L" : alert("잘못된경로입니다."); return;
					}
				}

			}
		} );

	}
}

//로그인
function do_login(ret_url){
	location.href="/member/member_login?ret_url="+ret_url;
}

//가격표시하기(,)
function fn_set_price(num) {

	num = parseInt(num *100)/100;
	set_str=''+num;

    if(num == null){
		set_str=0;
	 }
	if (num>=1000) {
		leng=set_str.length;
		set_str=parseInt(''+(num/1000))+','+set_str.substring(leng-3,leng);
	}
	if (num>=1000000) {
		leng=set_str.length;
		set_str=parseInt(''+(num/1000000))+','+set_str.substring(leng-7,leng);
	}
	if (num>=1000000000) {
		leng=set_str.length;
		set_str=parseInt(''+(num/1000000000))+','+set_str.substring(leng-11,leng);
	}
	if (num>=1000000000000) {
		leng=set_str.length;
		set_str=parseInt(''+(num/1000000000000))+','+set_str.substring(leng-15,leng);
	}
	return set_str;
}
