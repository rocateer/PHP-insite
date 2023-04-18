
		<!-- footer : s -->
    <footer>
      <ul>
        <li class="<?php if($this->uri->segment(1)==null || $this->uri->segment(1)==mapping("main")) echo "active";?>"><a href="/<?=mapping('main')?>"><span><img src="/images/menu_1.png" alt=""></span></a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("community")) echo "active";?>"><a href="javascript:community_check_in();"><span><img src="/images/menu_2.png" alt=""></span></a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("board")) echo "active";?>"><a href="/<?=mapping('board')?>"><span><img src="/images/menu_3.png" alt=""></span></a></li>
        <li class="<?php if($this->uri->segment(1)==mapping("mypage")) echo "active";?>"><a href="/<?=mapping('mypage')?>"><span><img src="/images/menu_4.png" alt=""></span></a></li>
      </ul>
    </footer>
    <!-- footer : e -->

    <script>
      function community_check_in(){

        if(member_idx!=''){
          if(member_gender!='1'){

            alert("죄송합니다. 커뮤니티는 여성 전용 서비스입니다. 다른 서비스를 이용해 주세요!");
            return;

          }else{
            location.href="/<?=mapping('community')?>";
          }
        }else{
          location.href="/<?=mapping('login')?>?return_url=/<?=mapping('community')?>";
        }
        
      }
    </script>

  </div>
  <!-- wrap : e -->
</body>
</html>
