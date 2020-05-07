<!-- <div>
	<img src="<?php echo base_url(); ?>assets/images/background/background.jpg" width="100%" height="600px">
	<div class="centered"><center><h2 style="font-weight: bold;">Student Portal for Better UnderStanding</h2><br><h4>Contribute here by Writing Answers for your favourite Subjects and Help others to understand the Subject Easily.</h4><br><button type="button" class="btn btn-success btn-lg">Contribute Here</button></center></div> -->
<div class="parallax" style="padding: 550px 0px 50px 0px;">
	<div class="centered"><center><h2 style="font-weight: bold;">Student Portal for Better UnderStanding</h2><br><h4>Contribute here by Writing Answers for your favourite Subjects and Help others to understand the Subject Easily.</h4><br><!-- <button type="button" class="btn btn-success btn-lg">Contribute Here</button> --></center></div>
</div>
<section style="padding: 50px 0px;">
	<div class="container">
		<center><h2 style="font-weight: bold;"><span style="border-bottom:4px solid black;">CSQueries</span></h2></center>
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-12">&nbsp;</div>
			<div class="col-lg-8 col-md-8 col-sm-12" style="font-size:15px;">
				<center>CSQueries is a Open Platform for Students to slove their Computer Science Doubts. CSQueries provides an easy and pointWise solution for the tough Questions. This platform contains a huge number of CS questions for the important Subjects like DataBase Management System, Data Structure & Algorithm, Operating System and many more computer Programming Languages.</center><br><br>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-12">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/write_for_us_2.png" alt="John" style="width:100%;height:200px;">
				  <h3>Write For Us</h3>
				  <p class="title"><center><button type="button" class="btn btn-primary btn-md">Start Here</button></center></p>
				  <br>
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/having_doubts.png" alt="John" style="width:100%">
				  <h3>Having Doubts?</h3>
				  <p class="title"><center><button type="button" class="btn btn-primary btn-md">Ask Us</button></center></p>
				   <br>
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="card">
				  <img src="<?php echo base_url(); ?>assets/images/aboutPictures/search_here.png" alt="John" style="width:100%;height:200px;">
				  <h3>Find Answers Quickly</h3>
				  <p class="title"><center><button type="button" class="btn btn-primary btn-md">Search</button></center></p>
				  <br>
				</div>
			</div>
		</div>
	</div>
</section>
<section style="background-color: #e9eeef91;">
<div class="container" style="padding-top: 20px;">
	<h3 style="font-weight: bold;">Browse By Categories</h3>
	<hr style="border:2px solid #66e066;">
	<div class="row">
<!-- 		<div class="col-md-1 col-lg-1 col-sm-12"></div> -->
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;DBMS</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category1 as $row){
						echo '<div class="col-sm-12 questionstyle"><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
					<!-- <div class="col-sm-12 questionstyle">What is DBMS? <span class="datestyle">-17th April,2020</span></div>
					<div class="col-sm-12 questionstyle">What is DBMS? <span class="datestyle">-17th April,2020</span></div>
					<div class="col-sm-12 questionstyle" >What is Entity Relationship Diagram in DBMS Entity Relationship Diagram? <span class="datestyle">-17th April,2020</span></div> -->
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/DBMS' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton">View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;Data Structure</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category2 as $row){
						echo '<div class="col-sm-12 questionstyle"><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/DataStructure' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton">View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;NetWorking</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category3 as $row){
						echo '<div class="col-sm-12 questionstyle"><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/NetWorking' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton">View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12" style="padding: 30px;">
			<div class="row categoryBoxes">
				<div class="col-sm-12" style="padding:1px;"><h3>&nbsp;&nbsp;NetWorking</h3><hr></div>
				<div class="col-sm-12" style="padding: 0px 10px;">
					<?php
					foreach($category3 as $row){
						echo '<div class="col-sm-12 questionstyle"><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle">'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></div>';
					}
					?>
				</div>
				<p>&nbsp;</p>
				<div class="col-sm-12 allQuestionButtonPlace"><a href="<?php echo base_url().'Category/NetWorking' ?>"><button type="button" class="btn btn-success btn-lg viewAllQuestionButton">View All Questions</button></a>&nbsp;&nbsp;&nbsp;</div>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
</div>
</section>