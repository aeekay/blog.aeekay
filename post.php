<?
    // site includes 
    $blog_post_id = $_GET['post'];

    $result = db_query("SELECT nid, title, uid, comment, field_revision_body.body_value AS content, created FROM node JOIN field_revision_body ON (field_revision_body.entity_id = node.nid) WHERE type = :type AND status=:status AND uid=:uid AND nid=:nid ORDER BY created DESC", array(':type' => 'blog', ':status' => 1, ':uid' => 1, ':nid' => $blog_post_id));
    foreach($result as $i_record) {
      $record = $i_record;
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$record->title?> | aeekay | Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//blog.aeekay.com/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="//blog.aeekay.com/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="//blog.aeekay.com/css/blog.css" rel="stylesheet" media="screen">
    <link href="//blog.aeekay.com/css/sub.css" rel="stylesheet" media="screen">
    <script src="//blog.aeekay.com/js/jquery.min.js"></script>
    <script src="//blog.aeekay.com/js/bootstrap.min.js"></script>
    <script src="//blog.aeekay.com/js/unslider.min.js"></script>
    <script src="//blog.aeekay.com/js/blog.js"></script>

    <!-- meta tags -->
    <meta name="description" content="<?=Inflector::truncate_teaser(strip_tags($record->content), 200)?>"/>
    <meta name="abstract" content="<?=Inflector::truncate_teaser(strip_tags($record->content), 200)?>"/>
    <meta name="keywords" content="aeekay, blog, Irvine, Orange County, IT, engineering"/>
    <meta name="robots" content="index,follow">
    <meta charset="UTF-8" />
  </head>
  <body class="sub post">
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
      <div class="void container-fluid">
        <div class="row-fluid">
          <div class="content-section span6" id="Content-Main">
            <div id="Breadcrumbs"><a href="//blog.aeekay.com">< Go back</a></div>
              <h3><?=$record->title?></h3>
              <div class="content"><?=$record->content?></div>
            <a href="//www.facebook.com/dialog/feed?app_id=325440157587357&link=<?=urlencode('http://blog.aeekay.com/post/'.$record->nid)?>&picture=<?=urlencode('http://blog.aeekay.com/img/logo.png')?>&name=<?=urlencode($record->title)?>&caption=<?=urlencode('I wanted to share this blog post with you')?>&redirect_uri=<?=urlencode('http://blog.aeekay.com')?>" target="_blank"><img src="//blog.aeekay.com/img/facebook32.png" alt="Share {title} on Facebook"/></a>
          </div>
          <div class="content-section span4" id="Content-Right">
            <form class="form-search">
              <div class="input-prepend input-append">
                <span class="add-on"><i class="icon-search"></i></span>
                <input type="text" class="input-medium" placeholder="Search the blog">
                <button type="submit" class="btn">Search</button>
              </div>
            </form>

            <div class="instagram-section">
              <h4>Instagram Photo</h4>
              <div class="content">
                <div class="section-text"><p>Here are some Instagram photos from my account, <a href="http://instagram.com/aeekaydotcom" target="_blank">aeekaydotcom</a>. Enjoy!</p></div>
                <div class="instagram-photos">
                  <ul>
                  <?
                    function fetchData($url){
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_URL, $url);
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                      curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                      $result = curl_exec($ch);
                      curl_close($ch); 
                      return $result;
                    }

                    $result = fetchData("https://api.instagram.com/v1/tags/aeekaydotcom/media/recent?access_token=292692711.ab103e5.77675f332ec445c0bf38e359ea051876");
                    $result = json_decode($result);
                    foreach ($result->data as $post) {
                  ?>

                      <li class="instagram-photo"><a href="<?=$post->link?>" target="_blank"><img src="<?=$post->images->low_resolution->url?>" alt="<?=$post->caption->text?>"/></a></li>
                  <?
                    }
                  ?>
                  </ul>
                </div>
            </div>
          </div>
        </div>
       </div>
    </div>
  </body>
</html>