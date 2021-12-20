<?php
include_once('resources/init.php');
//$posts = (isset($_GET['id'])) ? get_posts($_GET['id']) : get_posts();
$posts = get_posts((isset($_GET['id']))? $_GET['id'] : null); 
if(isset($_POST['submit'])){
   $name = $_POST['name'];
   $comment = $_POST['comment'];

   $sql = "INSERT INTO comments (name, comment)
            VALUES ('$name', '$comment')";

   $result = mysqli_query($conn,$sql);
   if($result){
      echo "<script>alert('Comment thành công')</script>";
   }else{
      echo "<script>alert('Comment thất bại')</script>";
   }

}
function postIndex($index, $value="")
{
	if (!isset($_POST[$index]))	return $value;
	return $_POST[$index];
}
?>
<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="vi"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="UTF-8">
	<title>HaLo News</title>
	<meta name="description" content="">  
	<meta name="author" content="">

	<!-- mobile specific metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

   <!-- CSS
    ================================================== -->
   <link rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="css/layout.css">  
	<link rel="stylesheet" href="css/media-queries.css"> 

   <!-- Script
   ================================================== -->
	<script src="js/modernizr.js"></script>

   <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.png" >

</head>

<body>

   <!-- Header
   ================================================== -->
   <header id="top">

   	<div class="row">

   		<div class="header-content twelve columns">

		      <h1 id="logo-text"><a href="index.php" title="">HaLo News</a></h1>

			</div>			

	   </div>

	   <nav id="nav-wrap"> 

	   	<a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show Menu</a>
		   <a class="mobile-btn" href="#" title="Hide navigation">Hide Menu</a>

	   	<div class="row">    		            

			   	<ul id="nav" class="nav">
			      	<li class="current"><a href="index.php">Trang Chủ</a></li>
			      	<li><a href="page.php">Về Chúng Tôi</a></li>
                  <li><a href="admin.php">Admin</a></li>
                  <li><a href="contact.php">Liên Hệ</a></li>
			   	</ul> <!-- end #nav -->			   	 

	   	</div> 

	   </nav> <!-- end #nav-wrap --> 	     

   </header> <!-- Header End -->

   <!-- Content
   ================================================== -->
   <?php
            foreach($posts as $post){
               ?>
   <div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  
  <div class="mySlides fade" box-sizing="border-box">
         <div><a href='index.php?id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></div>
         <div><?php echo date('d-m-y h:i:s',strtotime($post['date_posted'])); ?></div>
         <div><a href="#" title="" rel="category tag">In <a href='category.php?id=<?php echo $post['category_id']; ?>' ><?php echo "<font color='green'>".$post['name']."</font>"; ?></a></div>
         <div><?php echo nl2br($post['contents']); ?></div>   
   </div>

  <!-- Next and previous buttons 
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
</div>
<?php   
     }
     ?>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
  <span class="dot" onclick="currentSlide(4)"></span>
</div>
   <div id="content-wrap">

   	<div class="row">

   		<div id="main" class="eight columns">

	   		<article class="entry">
		<?php
     foreach($posts as $post){
      ?>
					<header class="entry-header">

						<h2 class="entry-title">
							<h2><a href='index.php?id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></h2>
						</h2> 				 
					
						<div class="entry-meta">
							<ul>
								<li> <?php echo date('d-m-y h:i:s',strtotime($post['date_posted'])); ?></li>
								<span class="meta-sep">&bull;</span>								
								<li><a href="#" title="" rel="category tag">In <a href='category.php?id=<?php echo $post['category_id']; ?>' ><?php echo "<font color='green'>".$post['name']."</font>"; ?></a></li>
								<span class="meta-sep">&bull;</span>
								<li><!-- Blogger user--></li>
							</ul>
						</div> 
					 
					</header> 
	
					
					<div class="entry-content">
						<p><?php echo nl2br($post['contents']); ?></p>
     </div>

									 <?php   
     }
     ?>
     <?php
      $id=postIndex("id");
      if(isset($id)){
      ?>
     <h2>Bình Luận</h2>
               <form action='' method='POST'>
        <input type='text' name='name' placeholder="Enter Your Name ..." class="text" required>
        <textarea id="comment" name='comment' placeholder="Enter Your Comment" class="text" required></textarea>
        <button class="button" type="submit" name="submit">Comment</button>
		</form>
      <div class="prev-comments">
         <?php
            $sql = "SELECT * FROM comments";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
               while ($row =mysqli_fetch_assoc($result)){
         ?>
         <div class="single-item">
         <h4><?php echo $row['name']; ?></h4>
         <p><?php echo $row['comment']; ?></p>
     </div>
     <?php
            }
         }
         ?>
					</div> 
               <?php
      }
      ?>
				</article> <!-- end entry -->

   		</div> <!-- end main -->

   		<div id="sidebar" class="four columns">

   			<div class="widget widget_search">
                  <h3>Tìm kiếm</h3> 
                  <?php
                     $search = postIndex("search");
                  ?>
                  <form name="search" action="index.php" method="post">

                  <input type="text" name="searchtitle" class="form-control" placeholder="Tìm kiếm ..." required>
                  <button class="button" type="submit" name="search">Tìm</button>

                  </form>
               </div>
            
   			<div class="widget widget_categories group">
   				<h3><a href="category_list.php">Danh Mục Tin</a></h3> 
   				<?php
     foreach(get_categories() as $category){
     ?>
      <p><a href="category.php?id=<?php echo $category['id'];?>"><?php echo $category['name']; ?></a>
     <?php  
     }
     ?>
				</div>

            <div class="widget widget_popular">
               <h3>Xem Nhiều Nhất</h3>

               <?php
     foreach($posts as $post){
      ?>
               <ul class="link-list">
                  <li><div><?php echo nl2br($post['contents']); ?></div>
                      <div><?php echo date('d-m-y h:i:s',strtotime($post['date_posted'])); ?></div>
                      <div><?php $sql = "SELECT count(comments.id) as sl FROM comments";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
               while ($row =mysqli_fetch_assoc($result)){
                  $bl=$row['sl']; 
                  echo "$bl comments";}}?></div>  </li>                     
               </ul>
               <?php   
     }
     ?>
            </div> 
   			
   		</div> <!-- end sidebar -->

   	</div> <!-- end row -->

   </div> <!-- end content-wrap -->
   

   <!-- Footer
   ================================================== -->
   <footer>

      <div class="row"> 

      	<div class="twelve columns">	
				<ul class="social-links">
               <li><a href="#"><i class="fa fa-facebook"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter"></i></a></li>
               <li><a href="#"><i class="fa fa-google-plus"></i></a></li>               
               <li><a href="#"><i class="fa fa-github-square"></i></a></li>
               <li><a href="#"><i class="fa fa-instagram"></i></a></li>
               <li><a href="#"><i class="fa fa-flickr"></i></a></li>               
               <li><a href="#"><i class="fa fa-skype"></i></a></li>
            </ul>			
      	</div> 
      <!--
         <div class="six columns info">

            <h3>About The Blog</h3> 

            <p>Just Keep it Simple!
            </p>

         </div> -->

        <!-- <div class="four columns">

            <h3>Photostream</h3>
            
            <ul class="photostream group">
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
               <li><a href="#"><img alt="thumbnail" src="images/thumb.jpg"></a></li>
            </ul>           

         </div> -->

       <!--  <div class="two columns">
            <h3 class="social">Navigate</h3>

            <ul class="navigate group">
               <li><a href="#">Home</a></li>
               <li><a href="#">Blog</a></li>
               <li><a href="#">Demo</a></li>
               <li><a href="#">Archives</a></li>
               <li><a href="#">About</a></li>
            </ul>
         </div> -->

         <p class="copyright">&copy; Copyright 2017. The Blog. &nbsp; Design by <a title="Styleshout" href="http://www.styleshout.com/">Styleshout</a>.</p>
        
      </div> <!-- End row -->

      <div id="go-top"><a class="smoothscroll" title="Back to Top" href="#top"><i class="fa fa-chevron-up"></i></a></div>

   </footer> <!-- End Footer-->


   <!-- Java Script
   ================================================== -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>  
   <script src="js/main.js"></script>

</body>

</html>