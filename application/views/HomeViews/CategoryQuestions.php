<?php
foreach($categoryQuestions as $row){
	$categoryName = $row['CategoryName'];
	$categoryDesc = $row['CategoryDescription'];
}
$links='';
if($countQuestionNumber>10){
	$numberofPage = $countQuestionNumber/10; 	//keeping 10 questions in 1 page
	$lastPage = $countQuestionNumber%10;
	$startRange = 0;
	$endRange = 10;
	for($iteration=1;$iteration<$numberofPage;$iteration++){
		$links = $links.'<li><a href="'.base_url().'Category/'.$categoryName.'/'.$startRange.'/'.$endRange.'">'.$iteration.'</a></li>';
		$startRange = $startRange +10;
		$endRange = $endRange +10;
	}
	$lastPage  = $startRange+$lastPage;
	$links = $links.'<li><a href="'.base_url().'Category/'.$categoryName.'/'.$startRange.'/'.$lastPage.'">'.$iteration.'</a></li>';
}else{
	$links = '';
}
?>
<section style="padding:80px 0px;background-color: #e9eeef91;">
	<div class="container">	
		<div class="col-lg-1 col-md-1 col-sm-1">
			&nbsp;
		</div>
		<div class="col-lg-10 col-md-10 col-sm-12  categoryBoxes">
			<ul class="breadcrumb">
			  <li><a href="#">CSQueries</a></li>
			  <li class="active"><?php echo $countQuestionNumber; ?></li>
			</ul>
			<h3><?php echo $categoryName; ?></h3>
			<p><?php echo $categoryDesc; ?></p>
			<br>
			<hr>
			<div class="row">
				<?php
					foreach($categoryQuestions as $row){
						echo '<div class="col-lg-12 col-md-12 col-sm-12">
								<h4>'.$row['Question'].'<span class="datestyle" style="font-size: 15px;"> &nbsp;'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></h4>
								<p style="color:grey;">Uploaded By: '.$row['UserName'].' <span class="datestyle" style="font-size: 15px;">Views: '.$row['Views'].'</span></p>
								<hr>
							</div>';
					}
				?>
				<!-- <div class="col-lg-12 col-md-12 col-sm-12">
					<h4>What is Dbms?<span class="datestyle" style="font-size: 15px;"> &nbsp;17th April,2020</span></h4>
					<p style="color:grey;">Uploaded By: KuntalSarkar <span class="datestyle" style="font-size: 15px;">Views: 10</span></p>
					<hr>
				</div> -->
			</div>
			<center><ul class="pagination pagination-lg"><?php echo $links; ?>
			    <!-- <li><a href="#">1</a></li>
			    <li><a href="#">2</a></li>
			    <li><a href="#">3</a></li>
			    <li><a href="#">4</a></li>
			    <li><a href="#">5</a></li> -->
			</ul></center>
		</div>
	</div>
</section>