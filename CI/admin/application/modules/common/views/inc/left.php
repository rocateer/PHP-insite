<?php 
$arr_right = explode(',',$this->admin_right); 

?>

<div id="wrapper">

  <!-- Navigation : s-->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/main"><?=SERVICE_NAME;?> 중앙관리시스템</a>
    </div>

    <ul class="nav navbar-right top-nav" style="margin-right:20px">
      <li class="dropdown"><a href="/admin_password/pw_mod"><i class="fa fa-cog"></i> 비밀번호변경</a></li>
      <li class="dropdown"><a href="/logout"><i class="fa fa-power-off"></i> 로그아웃</a></li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">

      <!-- side-nav : s -->
      <ul class="nav navbar-nav side-nav">

        <li class="side_nav_top">
          <p><strong><?=$this->admin_name?></strong> <span>님 환영합니다.</span></p>
          <p><span>ID : <?=$this->admin_id?></span></p>
        </li>


        <!-- 회원관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('member')||$this->uri->segment(1)==mapping('work')) echo "active";?>">
          <a href="#" data-toggle="collapse" data-target="#member">
            <span class="material-icons">
            people_alt
            </span>
            <span>회원 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="member" class="collapse <?php if($this->uri->segment(1)==mapping('member')||$this->uri->segment(1)==mapping('work')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('member')?>">회원 관리</a></li>
            <li><a href="/<?=mapping('work')?>">직종 승인 관리</a></li>
          </ul>
        </li>
        <!-- 회원관리 -->

        
        <!-- 커뮤니티 관리 -->
        <li class="<?php if($this->uri->segment(1) == mapping('board')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_board">
            <span class="material-icons">
            forum
            </span>
            <span>커뮤니티 게시판 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_board" class="collapse <?php if($this->uri->segment(1)==mapping('board')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('board')?>">게시판 큐레이션</a></li>
            <li><a href="/<?=mapping('board')?>/counselor_board_list">게시판 관리</a></li>
            <li><a href="/<?=mapping('board')?>/main_section_2">커뮤니티 게시글 관리</a></li>
            <li><a href="/<?=mapping('board')?>/main_section_2">구인 관리</a></li>
            <li><a href="/<?=mapping('board')?>/main_section_2">중고거래 게시글 관리</a></li>
          </ul>
        </li>
         <!-- 커뮤니티 관리 -->

        
        <!-- 메거진 관리  -->
        <li class="<?php if($this->uri->segment(1) == mapping('news')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_news">
            <span class="material-icons">category</span>
            <span>공동구매 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_news" class="collapse <?php if($this->uri->segment(1)==mapping('news')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('news')?>">공동구매 관리</a></li>
            <li><a href="/<?=mapping('news')?>">공동구매 투표 관리</a></li>
            <li><a href="/<?=mapping('news')?>/main_section_1">공동구매 Q&A 관리</a></li>
          </ul>
        </li>
        <!-- 메거진 관리  -->
    

        <!-- 카테고리관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('category_management')) echo "active";?>">

          <a href="#" data-toggle="collapse" data-target="#admin_category">
            <span class="material-icons">widgets</span>
            <span>교육 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_category" class="collapse <?php if( $this->uri->segment(1)==mapping('category_management') ) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('category_management');?>">교육 관리</a></li>
            <li><a href="/<?=mapping('category_management');?>">교육 투표 관리</a></li>
            <li><a href="/<?=mapping('category_management');?>/category_management1">교육 Q&A 관리</a></li>
          </ul>
        </li>
       <!-- 카테고리관리 -->


      <!-- 신고 관리 -->
        <li class="<?php if($this->uri->segment(1) == mapping('board_report')||$this->uri->segment(1) == mapping('board_reply_report')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_report">
            <span class="material-icons">
              report_problem
              </span>
            <span>신고관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_report" class="collapse <?php if($this->uri->segment(1)==mapping('board_report')|| $this->uri->segment(1)==mapping('board_reply_report')  ){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('board_report')?>">게시글 신고관리</a></li>
            <li><a href="/<?=mapping('board_reply_report')?>">게시글 댓글 신고관리</a></li>
            <li><a href="/<?=mapping('board_report')?>">중고거래 신고관리</a></li>
            <li><a href="/<?=mapping('board_reply_report')?>">중고거래 댓글 신고관리</a></li>
            <li><a href="/<?=mapping('report')?>">구인 신고관리</a></li>
            <li><a href="/<?=mapping('report')?>">구직프로필 신고관리</a></li>
            <li><a href="/<?=mapping('board_reply_report')?>">공구/교육 사전투표<br>댓글 신고관리</a></li>
          </ul>
        </li>
         <!-- 신고 관리 -->


          <!-- 배너관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('banner')) echo "active";?>">
          <a href="/<?=mapping('banner');?>" >
            <span class="material-icons">menu</span>
            <span>배너관리</span>
          </a>
        </li>
        <!-- 배너관리 -->


          <!-- 안내관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('info')) echo "active";?>">
          <a href="#" data-toggle="collapse" data-target="#info">
            <span class="material-icons">note</span>
            <span>안내 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="info" class="collapse <?php if( $this->uri->segment(1)==mapping('info') ) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('info');?>">안내 관리</a></li>
            <li><a href="/<?=mapping('info');?>/ban_list">차별금지 안내 관리</a></li>
          </ul>
        </li>
        <!-- 안내관리 -->


        <!-- 공지사항 -->
        <li class="<?php if($this->uri->segment(1)==mapping('notice')  ||  $this->uri->segment(1)==mapping('faq') ||  $this->uri->segment(1)==mapping('qa')) echo "active";?>">

          <a href="#" data-toggle="collapse" data-target="#admin_cscenter">
            <span class="material-icons">support_agent</span>
            <span>고객센터</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_cscenter" class="collapse <?php if( $this->uri->segment(1)==mapping('notice')  ||  $this->uri->segment(1)==mapping('faq') ||  $this->uri->segment(1)==mapping('qa') ) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('notice');?>">공지사항</a></li>
            <li><a href="/<?=mapping('faq');?>">FAQ 관리</a></li>
            <li><a href="/<?=mapping('qa');?>">1:1문의 관리</a></li>
          </ul>
        </li>
       <!-- 공지사항 -->
        

        <!-- 약관관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('terms')) echo "active";?>">
          <a href="/<?=mapping('terms');?>" >
            <span class="material-icons">edit</span>
            <span>약관관리</span>
          </a>
        </li>
        <!-- 약관관리 -->
       
      </ul>
      <!-- side-nav : e -->

    </div>
  </nav>
  <!-- Navigation : e -->

  <div id="page-wrapper">
