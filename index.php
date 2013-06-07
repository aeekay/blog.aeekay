<?
    // site includes 
    require_once 'common_dependencies.php';

      $result = db_query("SELECT nid, title, uid, comment, field_revision_body.body_value AS content, created FROM node JOIN field_revision_body ON (field_revision_body.entity_id = node.nid) WHERE type = :type AND status=:status AND uid=:uid ORDER BY created DESC", array(':type' => 'blog', ':status' => 1, ':uid' => 1));
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <title>aeekay | Blog</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
      <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
      <link href="css/blog.css" rel="stylesheet" media="screen">
      <link href="css/home.css" rel="stylesheet" media="screen">
      <script src="js/jquery.min.js" type="text/javascript"></script>
      <script src="js/bootstrap.min.js" type="text/javascript"></script>
      <script src="js/jquery.equalHeights.js" type="text/javascript"></script>
      <script src="js/blog.js" type="text/javascript"></script>
      <meta name="description" content="Welcome to my blog.  I'm an engineer who loves art.  I love to play the guitar, write poems, and different styles of art."/>
      <meta name="abstract" content="Welcome to my blog.  I'm an engineer who loves art.  I love to play the guitar, write poems, and different styles of art."/>
      <meta name="keywords" content="aeekay, blog, Irvine, Orange County, IT, engineering"/>
      <meta name="robots" content="index,follow">
      <meta charset="UTF-8" />
      <meta property="og:title" content="aeekay | Blog"/>
      <meta property="og:url" content="http://blog.aeekay.com" />
      <meta property="og:description" content="Welcome to my blog.  I'm an engineer who loves art.  I love to play the guitar, write poems, and different styles of art."/>
      <meta property="og:image" content="http://blog.aeekay.com/img/logo.png" />
    </head>
    <body class="home">
      <div id="PrimaryNavigation" class="sidebar">
        <div class="void">
        <h1><a href="//blog.aeekay.com"><span>aeekay's Blog</span></a></h1>
        <h2><span>Welcome to my blog.  I'm an engineer who loves art.  I love to play the guitar, write poems, and different styles of art.</span></h2>
        <div class="twitter-section">
          <h3><span>Twitter</span></h3>
          
          
        </div>
      </div>
    </div>
    
    <div id="Body" class="mainbody">
      <div class="void">
        <!-- OPEN THE FIRST ROW -->
        <div class="row-fluid blog-row">
          <?
            // current row count for the current row
            $current_row_count = 0; 
            $total_post_count = 1; 

            foreach($result as $record) { 
              // get the span of this particular block
              if(preg_match('/http\:\/\/www\.youtube\.com/', $record->content)) {
                $span = 8;
              } else {
                $span = 4; 
              }

              if(($current_row_count+$span)>12)
              {
                  $current_row_count = 0;
          ?>
        </div>
        <div class="row-fluid blog-row">
          <?  } 
          ?>
              <div class="span<?=$span?> blog-excerpt <?=Inflector::order($total_post_count);?>">
              <h3 class="title"><a href="/post/<?=$record->nid?>"><span><?=htmlspecialchars($record->title)?></span></a></h3>
              <div class="content">
                <?=Inflector::truncate_teaser($record->content, 250)?>
                <p class="read-more"><a href="/post/<?=$record->nid?>">Read More</a></p>
              </div>
              <ul class="excerpt-footer">
                <li class="date"><h4><?=str_replace('_', "<br/>", htmlspecialchars(date("M_j", $record->created)))?></h4></li>
                <li class="tags"><? if(count($record->tags) > 0) { ?><i class="icon-tag icon-white"></i> <a href="#"><span>Test</span></a>, <a href="#"><span>Test 2</span></a><? } ?></li>
                <li class="share-facebook"><a href="//www.facebook.com/dialog/feed?app_id=325440157587357&link=<?=urlencode('http://blog.aeekay.com/post/'.$record->nid)?>&picture=<?=urlencode('http://blog.aeekay.com/img/logo.png')?>&name=<?=urlencode($record->title)?>&caption=<?=urlencode('I wanted to share this blog post with you')?>&redirect_uri=<?=urlencode('http://blog.aeekay.com')?>" target="_blank"><img src="img/facebook32.png" alt="Share {title} on Facebook"/></a></li>
              </ul>
            </div>
          <?  $current_row_count +=$span;
              $total_post_count++;
              }
          ?>
        <!-- CLOSE THE LAST ROW -->
        </div>
      </div>
    </div>
  </body>
</html>