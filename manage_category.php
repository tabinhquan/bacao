<?php
include_once('resources/init.php');
$posts = get_posts(null,$_GET['id']);
?>
<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
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

	<script type="text/javascript">
function confirm_delete()
{
return confirm("Are you sure you want to delete this record?");
}
</script>

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
			      	<li ><a href="index.php">Trang Chủ</a></li>    	
			      	<li><a href="page.php">Về Chúng Tôi</a></li>
                  <li class="current"><a href="admin.php">Admin</a></li>
                  <li><a href="contact.php">Liên Hệ</a></li>
			   	</ul> <!-- end #nav -->			   	   	 

	   	</div> 

	   </nav> <!-- end #nav-wrap --> 	     

   </header> <!-- Header End -->

   <!-- Content
   ================================================== -->
   <div id="content-wrap">

   	<div class="row">

   		<div id="main" class="eight columns">

	   		<article class="entry">
					<header class="entry-header">
	    <?php
     foreach($posts as $post){

     ?>		 
					
						<div class="entry-meta">
	     <h2><a href='index.php?id=<?php echo $post['post_id']; ?>' ><?php echo $post['title']; ?></a></h2>
     <p>
        Posted on <?php echo date('d-m-y h:i:s',strtotime($post['date_posted'])); ?>
        In <a href='category.php?id=<?php echo $post['category_id']; ?>' ><?php echo $post['name']; ?></a>
     </p>
     <div><?php echo nl2br($post['contents']); ?></div>
     <menu>
        <ul>
            <li><a href='delete_post.php?id=<?php echo $post['post_id']; ?>' onclick='return confirm_delete()'><font color="red">Delete This Post</font></a>&nbsp;||</li>
            <li><a href='edit_post.php?id=<?php echo $post['post_id']; ?>' ><font color="blue">Edit This Post</font></a></li>
        </ul>
     </menu>
						</div> 
					 
					</header> 
	
					
					<div class="entry-content">
						<p><!--insert here--></p>
					</div> 

    <?php   
     }
     ?>
				</article> <!-- end entry -->

   		</div> <!-- end main -->

   		<div id="sidebar" class="four columns">

   			<div class="widget widget_search">
                  <h3>Tìm kiếm</h3> 
                  <form action="#">

                     <input type="text" value="Tìm kiếm ... " onblur="if(this.value == '') { this.value = 'Tìm kiếm ...'; }" onfocus="if (this.value == 'Search here...') { this.value = ''; }" class="text-search">
                     <input type="submit" value="" class="submit-search">

                  </form>
               </div>

   			<div class="widget widget_categories group">
   				<h3>Danh Mục Tin</h3> 
   				<?php
     foreach(get_categories() as $category){
     ?>
      <p><a href="manage_category.php?id=<?php echo $category['id'];?>"><?php echo $category['name']; ?></a>
     <?php  
     }
     ?>
				</div>

				<div class="widget widget_popular">
               <h3>Xem Nhiều Nhất</h3>

               <ul class="link-list">
                  <li><a href="https://haloshop.vn/tin-tuc/len-doi-ps5-tiet-kiem-den-6-trieu">Lên đời PS5, tiết kiệm đến 6 triệu đồng</a></li>
                  <li><a href="https://haloshop.vn/tin-tuc/nen-chon-mua-apple-watch-se-hay-apple-watch-series-5">Nên chọn Apple Watch SE hay Apple Watch Series 5?</a></li>
                  <li><a href="https://haloshop.vn/tin-tuc/tat-tan-tat-moi-thong-tin-ve-ps5-ma-ban-can-biet">Tất tần tật về mọi thông tin về PS5 mà bạn cần biết</a></li>                     
               </ul>
                  
            </div> 
   			
   		</div> <!-- end sidebar -->

   	</div> <!-- end row -->

   </div> <!-- end content-wrap -->
   

   <!-- Footer
   ================================================== -->
   <footer>

      <div class="row"> 

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