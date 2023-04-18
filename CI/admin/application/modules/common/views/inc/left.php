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

        <!-- section 1 : 회원관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('member')) echo "active";?>">
          <a href="/<?=mapping('member')?>">
            <span class="material-icons">people_alt</span>
            <span>회원 관리 &nbsp;</span>
          </a>
        </li>
        <!-- section 1 : 회원관리 -->

        <!-- section 5 : 신고 관리 -->
        <li class="<?php if($this->uri->segment(1) == mapping('board_report')||$this->uri->segment(1) == mapping('board_reply_report')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_report">
            <span class="material-icons">
              report_problem
              </span>
            <span>신고관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_report" class="collapse <?php if($this->uri->segment(1)==mapping('board_report')|| $this->uri->segment(1)==mapping('board_reply_report')  ){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('board_report')?>">게시글 신고 관리</a></li>
            <li><a href="/<?=mapping('board_reply_report')?>">댓글 신고</a></li>
          </ul>
        </li>
         <!-- section 5 : 신고 관리 -->

        <!-- section 5 : 커뮤니티 관리 -->
        <li class="<?php if($this->uri->segment(1) == mapping('board')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_board">
            <span class="material-icons">
            forum
            </span>
            <span>커뮤니티 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_board" class="collapse <?php if($this->uri->segment(1)==mapping('board')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('board')?>">오늘의 운동 완료 관리</a></li>
            <li><a href="/<?=mapping('board')?>/counselor_board_list">이브의 고민 관리</a></li>
            <li><a href="/<?=mapping('board')?>/main_section_2">베스트 이브의 고민 큐레이션</a></li>
          </ul>
        </li>
         <!-- section 5 : 커뮤니티 관리 -->

        <!-- section 2 : 떙그랑 메거진 관리  -->
        <li class="<?php if($this->uri->segment(1) == mapping('news')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_news">
            <span class="material-icons">
            widgets
            </span>
            <span>메거진 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_news" class="collapse <?php if($this->uri->segment(1)==mapping('news')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('news')?>">메거진 관리</a></li>
            <li><a href="/<?=mapping('news')?>/main_section_1">메거진 큐레이션</a></li>
          </ul>
        </li>
        <!-- section 2 : 떙그랑 메거진 관리  -->

        <!-- section 3 : 운동관리 -->
        <li class="<?php if($this->uri->segment(1) == mapping('exercise')|| $this->uri->segment(1)==mapping('program')){echo "active";} ?>">
          <a href="#" data-toggle="collapse" data-target="#admin_exercise">
            <span class="material-icons">
            list_alt
            </span>
            <span>운동 관리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_exercise" class="collapse <?php if($this->uri->segment(1)==mapping('exercise')|| $this->uri->segment(1)==mapping('program')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('exercise')?>">운동 관리</a></li>
            <li><a href="/<?=mapping('program')?>">프로그램 관리</a></li>
            <li><a href="/<?=mapping('exercise')?>/main_section_1">추천 운동 큐레이션</a></li>
          </ul>
        </li>
        <!-- section 3 : 운동관리 --> 
    
        <!-- section 6 : 카테고리관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('category_management')) echo "active";?>">

          <a href="#" data-toggle="collapse" data-target="#admin_category">
            <span class="material-icons">category</span>
            <span>카테고리</span> <span class="material-icons">arrow_drop_down</span>
          </a>

          <ul id="admin_category" class="collapse <?php if( $this->uri->segment(1)==mapping('category_management') ) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('category_management');?>">프로그램 카테고리 관리</a></li>
            <li><a href="/<?=mapping('category_management');?>/category_management1">이브의 고민 카테고리 관리</a></li>
          </ul>
        </li>
       <!-- section 8 : 카테고리관리 -->

        <!-- section 8 : 공지사항 -->
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
       <!-- section 8 : 공지사항 -->
        
        <!-- section 9 : 약관관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('terms')) echo "active";?>">
          <a href="/<?=mapping('terms');?>" >
            <span class="material-icons">edit</span>
            <span>약관관리</span>
          </a>
        </li>
        <!-- section 9 : 약관관리 -->
       
      </ul>
      <!-- side-nav : e -->

    </div>
  </nav>
  <!-- Navigation : e -->

  <div id="page-wrapper">
