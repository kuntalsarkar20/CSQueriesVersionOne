<!-- <div>
	<img src="<?php echo base_url(); ?>assets/images/background/background.jpg" width="100%" height="600px">
	<div class="centered"><center><h2 style="font-weight: bold;">Student Portal for Better UnderStanding</h2><br><h4>Contribute here by Writing Answers for your favourite Subjects and Help others to understand the Subject Easily.</h4><br><button type="button" class="btn btn-success btn-lg">Contribute Here</button></center></div> -->
<div class="parallax" style="padding: 550px 0px 50px 0px;">
	<div class="centered"><center>
		<h2 class="ml14">
		  <span class="text-wrapper">
		    <span class="letters" style="color:black;">CSQuery: A Student's Portal</span>
		    <span class="line" style="color:black;"></span>
		  </span>
		</h2>
		<br>
		<h4 class="ml16" style="color:;">MADE WITH LOVE.</h4><br><!-- <button type="button" class="btn btn-success btn-lg">Contribute Here</button> --></center></div>
</div>

<section style="padding: 50px 0px;">
	<div class="container">
		<center><h2 style="font-weight: bold;"><span style="border-bottom:4px solid black;">CSQuery</span></h2></center>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-12">&nbsp;</div>
			<div class="col-lg-8 col-md-8 col-sm-12" style="font-size:15px;">
				<center>CSQuery is a Open Platform for Students to slove their Computer Science Doubts. CSQuery provides an easy and pointWise solution for the tough Questions. This platform contains a huge number of CS questions for the important Subjects like DataBase Management System, Data Structure & Algorithm, Operating System and many more computer Programming Languages.</center><br><br>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 about-section-img-con" data-aos="fade-up" data-aos-duration="2000">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/write_for_us_2.png" class="about-section-img" alt="John" style="width:80%;height:180px;">
				  <h3>Write For Us</h3>
				  <!-- <div class="about-section-img-middle">
				  <p class=""><center><button type="button" class="about-section-button">Start Here</button></center></p>
				  </div> -->
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-12 about-section-img-con" data-aos="fade-up" data-aos-duration="2000">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/having_doubts.png" alt="John" class="about-section-img" style="width:80%;height:180px;">
				  <h3>Having Doubts?</h3>
				  <!-- <div class="about-section-img-middle">
				  <p class=""><center><button type="button" class="about-section-button">Start Here</button></center></p>
				  </div> -->
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-lg-3 col-md-3 col-sm-12 about-section-img-con" data-aos="fade-up" data-aos-duration="2000">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/search_here.png" alt="John" class="about-section-img" style="width:80%;height:180px;">
				  <h3>Find Answers Quickly</h3>
				  <!-- <div class="about-section-img-middle">
				  <p class=""><center><button type="button" class="about-section-button">Start Here</button></center></p>
				  </div> -->
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Browse By Categories Section Starts-->
<section style="background-color: #e9eeef91;">
<div class="container" style="padding-top: 20px;">
	<h3 style="font-weight: bold;" data-aos="fade-up" data-aos-duration="2000">Browse By Categories</h3>
	<hr style="border:2px solid #66e066;" data-aos="fade-up" data-aos-duration="2000">
	<div class="row">
<!-- 		<div class="col-md-1 col-lg-1 col-sm-12"></div> -->
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;" data-aos="fade-up" data-aos-duration="2000">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;DBMS</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category1 as $row){
						echo '<div class="col-sm-12 questionstyle"> <span class="glyphicon glyphicon-hand-right"></span> <a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.((strlen($row['Question'])>70) ? substr($row['Question'],0,70).'..':$row['Question']).'</a><br><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
					<!-- <div class="col-sm-12 questionstyle">What is DBMS? <span class="datestyle">-17th April,2020</span></div>
					<div class="col-sm-12 questionstyle">What is DBMS? <span class="datestyle">-17th April,2020</span></div>
					<div class="col-sm-12 questionstyle" >What is Entity Relationship Diagram in DBMS Entity Relationship Diagram? <span class="datestyle">-17th April,2020</span></div> -->
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/DBMS' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton"><span class="glyphicon glyphicon-th-list"></span> View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;" data-aos="fade-up" data-aos-duration="2000">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;Data Structure</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category2 as $row){
						echo '<div class="col-sm-12 questionstyle"> <span class="glyphicon glyphicon-hand-right"></span> <a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.((strlen($row['Question'])>70) ? substr($row['Question'],0,70).'..':$row['Question']).'</a><br><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/DataStructure' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton"><span class="glyphicon glyphicon-th-list"></span> View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;" data-aos="fade-up" data-aos-duration="2000">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;NetWorking</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category3 as $row){
						echo '<div class="col-sm-12 questionstyle"> <span class="glyphicon glyphicon-hand-right"></span> <a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.((strlen($row['Question'])>70) ? substr($row['Question'],0,70).'..':$row['Question']).'</a><br><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/NetWorking' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton"><span class="glyphicon glyphicon-th-list"></span> View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;" data-aos="fade-up" data-aos-duration="2000">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;NetWorking</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category3 as $row){
						echo '<div class="col-sm-12 questionstyle"> <span class="glyphicon glyphicon-hand-right"></span> <a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.((strlen($row['Question'])>70) ? substr($row['Question'],0,70).'..':$row['Question']).'</a><br><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/NetWorking' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton"><span class="glyphicon glyphicon-th-list"></span> View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
</div>
</section>
	<!-- Browse By Categories Section Ends-->
	<!-- Contributer Section Starts-->
<!-- Contributer -->
<section style="padding:80px 0px;background-image: url(<?php base_url() ?>assets/images/background/ContributerWithBlackCover.jpg);background-size: 100% 100%;">
	<!-- <div style="background-color: rgb(0,0,0,0.5);"> -->
<div class="container" style="background-color:;height: 500px;">
  <div class="row">
    <div class="col-sm-offset-1 col-lg-10 col-md-10 col-sm-12">
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner" style="border:2px solid #ffff;">
        	

        	<?php 
        	$count=1;
		foreach($top3Contributers as $row){
			// echo '<div class="testimonial-mySlides" style="background-color:whitesmoke;">
			// 		<img src="'.base_url().'assets/images/UserProfilePictures/'.$row['Image'].'" alt="'.$row['Name'].'" style="height:140px;width:140px;border-radius: 50%;"><br>
			// 		<p class="testimonial-author">'.$row['Name'].'</p>
			// 	  <q class="testimonial-q">'.$row['About'].'</q>
			// 	  <br><a href="'.base_url().$row['UserName'].'"><button type="button" class="pofilebutton">View Profile</button></a>
			// 	</div>';
			if($count==1) $active ="active";
			else $active= '';
			$count++;
				echo '<div class="item '.$active.'">
 	        <div class="row">
                <div class="col-sm-12 hidden-xs">
                	&nbsp;&nbsp;
                </div>
               <div class="col-sm-12 hidden-xs" style="overflow:hidden;height:420px;">
               	<div class="col-sm-12" style="margin-top: 70px;position:absolute;border-top:4px solid white;width:100%;text-align:center;">
               		<div style="position: absolute;top: -70px; /* half of image height */ left:40%; /* right space */text-align:center;"><img class="img-circle center" src="'.base_url().'assets/images/UserProfilePictures/'.$row['Image'].'" style="width: 120px;height:120px;display:block;border:4px solid white;">
				</div>
				<br><br><br>
				<div class="col-sm-12 hidden-xs">
                	&nbsp;&nbsp;
                </div>
               		<p style="color: white;text-align:center;padding:5px;">'.$row['About'].'</p>
               		<a href="'.base_url().$row['UserName'].'" class="links-col"><p style="font-weight: bold;font-size: 25px;text-align: center;">'.$row['Name'].'</p></a>
               		</div>
            </div>
            <div class="col-sm-12 hidden-lg hidden-md hidden-sm" style="overflow:hidden;height:420px;">
               	<div class="col-sm-12" style="margin-top: 70px;position:absolute;border-top:4px solid white;width:100%;">
               		<div style="position: absolute;top: -70px; /* half of image height */ left: 30%; /* right space */"><img class="img-circle center" src="'.base_url().'assets/images/UserProfilePictures/'.$row['Image'].'" style="width: 120px;height:120px;display:block;border:4px solid white;">
				</div>
				<br><br><br>
				<div class="col-sm-12 hidden-xs">
                	&nbsp;&nbsp;
                </div>
               		<p style="color: white;text-align:center;padding:5px;">'.$row['About'].'</p>
               		<a href="'.base_url().$row['UserName'].'" class="links-col"><p style="font-weight: bold;font-size: 25px;text-align: center;">'.$row['Name'].'</p></a>
               		</div>
            </div>
              </div>
          </div>';
		}
		?>
		
        
          <!-- Quote 1 -->
          <!-- <div class="item">
 	        <div class="row">
                <div class="col-sm-12 hidden-xs">
                	&nbsp;&nbsp;
                </div>
               <div class="col-sm-12 hidden-xs" style="overflow:hidden;height:420px;">
               	<div class="col-sm-12" style="margin-top: 70px;position:absolute;border-top:4px solid white;">
               		<div style="position: absolute;top: -70px; /* half of image height */ left: 40%; /* right space */"><img class="img-circle center" src="<?php echo base_url(); ?>assets/images/aboutPictures/search_here.png" style="width: 120px;height:120px;display:block;border:4px solid white;">
				</div>
				<br><br><br>
				<div class="col-sm-12 hidden-xs">
                	&nbsp;&nbsp;
                </div>
               		<p style="color: white">Desk top view</p>
               		<a href="" class="links-col"><p style="font-weight: bold;font-size: 25px;text-align: center;">Kuntal Sarkar</p></a>
               		</div>
            </div>
              </div>
          </div> -->
 		<!-- Carousel Buttons Next/Prev -->
        <!-- <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a> -->
      </div>                          
    </div>
    </div>
</div>
</div>
<!-- </div> -->
</section>
<!-- Contributer Section Ends-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script type="text/javascript">
	// Wrap every letter in a span
var textWrapper = document.querySelector('.ml14 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml14 .line',
    scaleX: [0,1],
    opacity: [0.5,1],
    easing: "easeInOutExpo",
    duration: 900
  }).add({
    targets: '.ml14 .letter',
    opacity: [0,1],
    translateX: [40,0],
    translateZ: 0,
    scaleX: [0.3, 1],
    easing: "easeOutExpo",
    duration: 800,
    offset: '-=600',
    delay: (el, i) => 150 + 25 * i
  }).add({
    targets: '.ml14',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });

 // Wrap every letter in a span
var textWrapper = document.querySelector('.ml16');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml16 .letter',
    translateY: [-100,0],
    easing: "easeOutExpo",
    duration: 1400,
    delay: (el, i) => 30 * i
  }).add({
    targets: '.ml16',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>