<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!-- <link href='http://fonts.googleapis.com/css?family=roboto:400,600,700' rel='stylesheet' type='text/css'> -->
<link rel="stylesheet" href="/css/style.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/scripts.js"></script>
<body>
  <div id="container">
    <!-- the accordion starts here //-->
    <div id="accordion">
      <?php
      $i=0;
      foreach ($result_list as $row ) {
      ?>
        <ul class="panels">
          <li data-panel-id="panel<?=$i?>" >
          <?=$row->title?>
          </li>
          <div class="panel panel<?=$i?>">
            <?=nl2br($row->contents)?>
          </div><!--panel panel-->
        </ul>
      <?php
      $i++;
      }
      ?>
    </div><!--accordion-->
  </div><!--container-->
</body>
