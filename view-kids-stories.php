<?php
session_start();
$link="$_SERVER[REQUEST_URI]";
$links=explode("/",$link);
if(count($links)==2)
{
    $seo=$links[1];
}  else {
    $seo=$links[2];
}
if(isset($_REQUEST['comment']))
{
$seo=substr($seo, 11);
$seo=rtrim($seo,'comment#stories');
$seo=substr_replace($seo, '', -1);
}else
{
  $seo=substr($seo, 11); 
}
include("dbconnection.php");
$story_detail=  getStoryBySeo($seo);    
    $detailstory=  mysql_fetch_array($story_detail);
    $story_id=$detailstory['story_id'];
?>
<!doctype html>
<html lang="en">
<head>
<meta content="<?php echo $detailstory['meta_tag_keyword']; ?>" name="keywords"  />
<meta content="<?php echo $detailstory['meta_tag_description']; ?>" name="description"/>
<title><?php echo $detailstory['story_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/styletwo.css"/>
<script src="js/jquery-1.4.4.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script>
  $(document).ready(function() {    
	$("#scroll").niceScroll();

  });
</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

<script type="text/ javascript">
  stLight.options({
    publisher: "f8d3544a-e416-42e8-a46a-96452a910eb1", 
    popup: true,
    doNotHash: false, 
    doNotCopy: false, 
    hashAddressBar: false
 });
 </script>
<meta property="og:image" content="http://www.thefunkids.com/stories/story_images/<?php echo $share_story_img=$detailstory['story_image']; ?>" />

</head>
<body>
<?php 
include_once("analyticstracking.php");
?>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=481352955356475";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php 
include("includes/header.php");
?>
    
<div class="container-fluid">
  <div class="row"> <img src="images/cloud-1.png" alt="" class="cloud"/> </div>
</div>
<section class="sec1">
  <div class="container">
  <div class="row">
   <div class="col-lg-10">
  
    <div class="row">
      <div class="col-lg-6"> 
       <?php  
  echo $detailstory['story_code'];  
  ?>
          <div class="row">
      <div class="col-lg-12">
        <div class="share-video">
          <div class="row">
            <div class="col-lg-5">
              <h2 style="font-size:19px; padding-top:5px;">Share This Video</h2>
            </div>
            <div class="col-lg-7 text-right"> 
            <?php include("includes/share-buttons-links.php"); ?>
			</div>
          </div>
        </div>
      </div>
    </div>
      
      
      </div>
      
      <div class="col-lg-6"> 
      <div class="video-detail" id="scroll">
      <h2>
      <?php 
      echo $detailstory['story_name'];
      ?>
      
      </h2>
      
      <p>
      <?php 
        echo $detailstory['story_decription'];
      ?>
      </p>
      
      </div>
      
      
      </div>
    </div>
    
  
    </div>
    
    
    
     <?php
     include("right-detail-adds.php");
     ?>
    
    </div>   
    
      <?php 
   if(!isset($_SESSION['user_id']))
   {   
   ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="leave-comment">
          <div class="row">
            <div class="col-lg-9 col-sm-4">
              <h2>Leave A Comment<br/>
                <span>You need to log in for commenting</span> </h2>
            </div>
            <div class="col-lg-3 col-sm-4"> <a href="/signup-mother-baby-forum" class="btn-coment sign-up">SIGN UP</a> <a href="/login-kid-mom-forum" class="btn-coment sign-in">LOG IN</a> </div>
          </div>
        </div>
      </div>
    </div>
      <?php
   }
   ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="comment-wrap">
            <a name="stories"> </a>
            <br>
    <?php
    if(isset($_REQUEST['comment']))
    {
    ?>
    <p class="text-center modiration">Your Comment Waiting For Moderation ...</p> 
    <?php
    }
    ?>
    <?php
    if(isset($_REQUEST['error']))
    {
    ?>
    <p class="text-center modiration">Please Login for comments</p>   
    <?php
    }
    ?>
            <form method="post" action="dopoststorycomments.php">
                 <input type="hidden" name="story_id" value="<?php echo $story_id; ?>"/>
          <textarea name="comments" id="comments" cols="" rows=""></textarea>
            <a href="#stories"><input type="submit" name="submit" value="POST A COMMENT" class="btn-coment sign-in"></a></div>
</form>
          
          <div class="discus">
         
<?php

    $rhyme_comment=getApproveStoryComment($story_id);
    if($rhyme_comment>0)
    {
       while($rhymecomment=  mysql_fetch_array($rhyme_comment))
       {
          $user_id=$rhymecomment['user_id'];          
          $user_comment=  getUserById($user_id);
          while($user=  mysql_fetch_array($user_comment))
          {
    ?>
    <div class="action">
        <h4>  
    <?php
        echo $user['name'];
        ?>
            </h4>
    <br/>
    <?php
    if($user['userimages']!='')
    {
    ?>
    <img src="userimages/<?php echo $user['userimages']; ?>" alt="" width="70" height="70"/>
    <?php
    }elseif(isset($_SESSION['FBID']))
    {
    ?>
    <img src="https://graph.facebook.com/<?php echo $user['Fuid'] ?>/picture" width="70" height="70">
    <?php
    }else{
    ?>
    <img src="images/user-avatar.png" alt=""/>
    <?php
    }
    ?>
    <p><?php echo $rhymecomment['comments']; ?> 
        <br/><?php if($rhymecomment['isActive']=='no'){ echo"your comments are pending and waiting for approval";   }?> </p>
   <div class="clearfix"></div>  
   

         
                    
<?php 
if(isset($_SESSION['user_id']))
{
if($_SESSION['user_id']==$rhymecomment['user_id'])
{
?>
         
   <div class="share">   <a href="edit-story-comment.php?id=<?php echo $story_id; ?>&story_comment_id=<?php echo $rhymecomment['story_comment_id']; ?>">Edit | </a>  <a href="delete-story_comment.php?id=<?php echo $rhymecomment['story_comment_id']; ?>&story_id=<?php echo $story_id; ?>">Delete</a></div>
<?php
}
}   
?>     
<?php 
if(isset($_SESSION['FBID']))
{
    $user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
if($user_facebook_id){
$face_book_user=  mysql_fetch_array($user_facebook_id);
$user_id=$face_book_user['user_id'];
}
if($user_id==$rhymecomment['user_id'])
{
?>         
   <div class="share"> <a href="edit-story-comment.php?id=<?php echo $story_id; ?>&story_comment_id=<?php echo $rhymecomment['story_comment_id']; ?>">Edit | </a>  <a href="delete-story_comment.php?id=<?php echo $rhymecomment['story_comment_id']; ?>&story_id=<?php echo $story_id; ?>">Delete</a></div>
<?php
}
}   
?>           
        
        

    
       
       
        <!-- <div><a href="edit-rhyme_comment.php?id=<?php //echo $rhyme_id; ?>&rhyme_comment_id=<?php // echo $rhymecomment['rhyme_comment_id']; ?>">Edit</a>  <a href="delete-rhyme_comment.php?id=<?php //echo $rhymecomment['rhyme_comment_id']; ?>&rhyme_id=<?php //echo $rhyme_id; ?>">Delete</a></div>
    -->    
   
 <br>    
    <div class="clearfix"></div> 
    
    </div> 
    
    
    <?php
       }
    }
    }
    ?>
</div>
      </div>
    </div>
    
    <div class="row">
      <?php 
      include("right-detail-page-adds.php");
      ?>
      <div class="col-lg-9">
        <div class="red-bg">
          <div class="row">
            <div class="col-lg-3"> <img src="images/puzzle-collage.jpg" alt="" class=""/> </div>
            <div class="col-lg-9">
              <p>Welcome to Fun Kids, we bring exciting rhymes, games, puzzles and stories for your little angels.  Along with Kids section, we have discussion forums and other activities related to Moms and parenting.To make your journey more exciting with us, we come up with monthly contest and sweepstakes, where you can participate and win super mom gifts from us. We hope your journey with us will be refreshing and full of fun, do login daily to catch any surprise gifts coming your way. parenting.To make your journey more exciting with us, we come up with monthly contest and sweepstakes, where you can participate and win super mom gifts from us. We hope your journey with us will be refreshing and full of fun, do login daily to catch any surprise gifts coming your way.will be refreshing and full of fun, do login daily to catch any surprise gifts coming your way.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php 
    include("rhymes-stories-puzzles-games.php");
    
    ?>
    
    
  </div>
</section>
<div class="container-fluid">
  <div class="row"> <img src="images/cloud-2.png" alt="" class="cloud"/> </div>
</div>
<?php 
include("includes/footer.php");
?>
</body>
</html>