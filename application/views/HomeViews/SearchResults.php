<section style="padding:80px 0px;background-color: #e9eeef91;" id="searchResults-section">
	<div class="container">	
		<div class="col-lg-1 col-md-1 col-sm-1">
			&nbsp;
		</div>
		<div class="col-lg-10 col-md-10 col-sm-12  categoryBoxes">
			<p style="padding-top: 20px;">You Searched for "<strong><?php echo $SearchString; ?></strong>"</p>
			<hr style="border:2px solid green;margin-top: 0px;margin-bottom: 0px;">
			<ul class="breadcrumb">
			<li><p style="color:grey;font-size: 14px;">Showing about <?php echo $countQuestionNumber; ?> results.(<?php echo round($TimeTaken,6); ?> Seconds)</p></li>
			</ul>	<!--  Each page showing 10 records. so added 9 with start value-->
			<hr>			
			<div class="row">
				<!-- <div class="col-lg-12 col-md-12 col-sm-12">
					<h4>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and ?<span class="datestyle" style="font-size: 15px;"> &nbsp;17th April,2020</span></h4>
					<p style="color:grey;">Uploaded By: KuntalSarkar &nbsp; &nbsp; Category: DBMS &nbsp;&nbsp; Relevance Found: 6.254 <span class="datestyle" style="font-size: 15px;">Views: 10</span></p>
					<hr>
				</div> -->
				<?php
				if(!empty($SearchResults)){
					foreach($SearchResults as $row){
						echo '<div class="col-lg-12 col-md-12 col-sm-12">
								<h4><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a><span class="datestyle" style="font-size: 15px;"> &nbsp;'.date('d-M-Y',strtotime($row['CreatedAt'])).'</span></h4>
								<p style="color:grey;">Uploaded By: <a href="'.base_url().$row['UserName'].'">@'.$row['UserName'].'</a> &nbsp; &nbsp; Category: <a href="'.base_url().'Category/'.$row['CategoryName'].'">'.$row['CategoryName'].'</a> &nbsp;&nbsp; Relevance: '.round(($row['relevance'])*10,2).'% <span class="datestyle" style="font-size: 15px;"><span class="glyphicon glyphicon-eye-open"></span> '.$row['Views'].'</span></p>
								<hr>
							</div>';
					}
				}else{
					echo "NO Results Found.";
				}
				?>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.getElementById('searchResults-section').style.minHeight=screen.height+"px";
</script>