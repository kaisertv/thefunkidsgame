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
$seo=rtrim($seo,'comment#puzzles');
$seo=substr_replace($seo, '', -1);
}else
{
  $seo=substr($seo, 11); 
}
include("dbconnection.php");
$puzzle_detail= getPuzzleBySeo($seo);
    $puzzle= mysql_fetch_array($puzzle_detail);  
    $puzzle_id=$puzzle['puzzle_id'];
?>
<!doctype html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="<?php echo $puzzle['meta_tag_keyword']; ?>" name="keywords"  />
<meta content="<?php echo $puzzle['meta_tag_description']; ?>" name="description"/>
<meta name="robots" content="noindex">
<title><?php echo $puzzle['puzzle_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/styletwo.css"/>
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

 
<meta property="og:image" content="http://www.thefunkids.com/funkid-puzzles/puzzle_images/<?php echo $share_img_puzzle=$puzzle['puzzle_image']; ?>" />

</head>
<body>
<?php include_once("analyticstracking.php"); ?>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=481352955356475";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php include( "includes/header.php"); ?>
<div class="container-fluid">
  <div class="row"> <img src="images/cloud-1.png" alt="" class="cloud"/> </div>
</div>
<section class="sec1">
  <div class="container">
    <div class="row">
      <div class="col-lg-12"> <div id="flashContent">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1140" height="500" id="PUZZLE TWO" align="middle">
				<param name="movie" value="funkid-puzzles/puzzle_files/<?php echo $puzzle['puzzle_file']; ?>" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="funkid-puzzles/puzzle_files/<?php echo $puzzle['puzzle_file']; ?>" width="1140" height="500">
					<param name="movie" value="funkid-puzzles/puzzle_files/<?php echo $puzzle['puzzle_file']; ?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
					<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
					</a>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
		</div> </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="share-video">
          <div class="row">
            <div class="col-lg-9">
              <h2>Share This Puzzle</h2>
            </div>
            <div class="col-lg-3 text-right"> 
            <?php include("includes/share-buttons-links.php"); ?>
			</div>
          </div>
        </div>
      </div>
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
            <div class="col-lg-3 col-sm-4"> <a href="javascript;" class="btn-coment sign-up">SIGN UP</a> <a href="javascript;" class="btn-coment sign-in">LOG IN</a> </div>
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
            <a name="puzzles"> </a>
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
    
    <form method="post" action="doaddpuzzlecoment.php">
     <input type="hidden" name="puzzle_id" value="<?php echo $puzzle_id; ?>"/>
     <textarea name="comments" id="comments" cols="" rows=""></textarea>
     <a href="#puzzles"><input type="submit" name="submit" value="POST A COMMENT" class="btn-coment sign-in"></a>
    </form>
     <div class="clearfix"></div>  
    <div class="discus">
         
<?php

    $rhyme_comment=getApprovePuzzlesComment($puzzle_id);
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
<div class="share"> <a href="edit-puzzle_comment.php?id=<?php echo $puzzle_id; ?>&puzzle_comment_id=<?php echo $rhymecomment['puzzle_comment_id']; ?>">Edit |</a>  <a href="delete-puzzle-comment.php?id=<?php echo $rhymecomment['puzzle_comment_id']; ?>&puzzle_id=<?php echo $puzzle_id; ?>">Delete</a> </div>
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
<div class="share"> <a href="edit-puzzle_comment.php?id=<?php echo $puzzle_id; ?>&puzzle_comment_id=<?php echo $rhymecomment['puzzle_comment_id']; ?>">Edit |</a>  <a href="delete-puzzle-comment.php?id=<?php echo $rhymecomment['puzzle_comment_id']; ?>&puzzle_id=<?php echo $puzzle_id; ?>">Delete</a> </div>
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
   <div class="clearfix"></div>  
            
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
    <?php include "rhymes-stories-puzzles-games.php"; ?>
  </div>
</section>
<div class="container-fluid">
  <div class="row"> <img src="images/cloud-2.png" alt="" class="cloud"/> </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>