<?php 
foreach ($question as $row) {
	$cId=$row['ContentId'];
	$contentName= $row['Question'];
	$contentDesc= $row['Answer'];
	$contentCategory = $row['CategoryId'];
	$contentTags = $row['ContentTags'];
	if($row['isPublished']==0){
		$btnText = 'Update & Publish';
	}else{
		$btnText = 'Update & UnPublish';
	}
	}
?>

<section style="padding:55px 0px;">
		<div class="container">
			<ul class="breadcrumb">
			    <li><a href="<?php echo base_url().$_SESSION['username']; ?>">Profile</a></li>
			    <li><a href="<?php echo base_url().$_SESSION['username'].'/myContents'; ?>">My Contents</a></li>   
			    <li class="active">Edit Content</li>        
			</ul>
		</div>
	<div class="container">
		<?php
		  if($this->uri->segment(7)=="UpdateFailed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Update Failed</strong> Please check you have properly entered all the mandatory field and try again.
			  </div>';
		  }
		  ?>
		<div class="row">
			<form method="post" action="<?php echo base_url();?>contentManagement/uploadContentController/editContent">
			<input type="hidden" name="ContentId" value="<?php echo $cId; ?>">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label for="psw">Select any Topic</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <select class="form-control" id="topic" name="category" onchange="getTopicQuestions()" required>
				        <?php 
					        foreach ($category as $row) {
					        	if($row['CategoryId']==$contentCategory){
					        		$select = 'selected="selected"';
					        	}else{
					        		$select = '';
					        	}
								echo '<option value="'.$row['CategoryName'].'" '.$select.'  id="topicName'.$row['CategoryId'].'">'.$row['CategoryName'].'</option>';
							}
						?>
				        
				      </select>
			      </div>
			      <h5 style="float: right;padding-right: 30px;">Topic not listed?</h5>
			  	</div>
			  	<p>&nbsp;</p>
			  	<label for="psw">Your Content Heading/Question</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="10" id="contentHeading" name="contentName" required><?php echo $contentName; ?></textarea> 
			      </div>
			  	</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12"><h4 style="font-weight: bold;">Already Uploaded Questions From this Topic</h4>
				<div style="height:310px;overflow: scroll;border: 2px solid black;" id="relatedQuestionBox">
				
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Your Content Explaination/Answer</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="5" id="contentAns" name="contentDetails"><?php echo htmlspecialchars($contentDesc); ?></textarea>
			      </div>
			  	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Tags/Keywords for your Content(You can add Multiple tags):</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <input type="text" value="<?php echo $contentTags; ?>" data-role="tagsinput" name="Ctag"> 
			      </div>
			  	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
			  	<!-- <p style="padding-left: 30px;">Auto Saved(Not Published)</p> -->
			  	<br>
			  	<button type="submit" name="updateAndToggle" class="btn btn-success btn-md" id="upload-btn" style="float:right;margin-left:20px;" title="It will  be published and anyone can able to view this."><?php echo $btnText; ?></button>
			  	<button type="submit"  name="update" class="btn btn-primary btn-md" id="upload-btn" style="float:right;right: 5px;" title="It will not be published until you publish it.">Update</button>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<blockquote>
					<h4 style="font-weight: bold;">Note:</h4>
				    <ul>
				    	<li style="font-size: 15px;"><strong>Update</strong> Button will only update the existing Content. Visibility Status will remain Same. That means if the content is published then it will remain published and if it is not published then it will remain private.</li>
				    	<li style="font-size: 15px;"><strong>Update & Publish:</strong>It means yout content will be updated and published too.</li>
				    	<li style="font-size: 15px;"><strong>Update & UnPublish:</strong>It means your content will be updated but it will be made private.</li>
				    </ul>
				    <p style="font-size: 17px;">You will be able to see only 2 Buttons. One is <strong>Update</strong> and either <strong>Update & Publish</strong> or <strong>Update & UnPublish</strong> based on your question visibility Status.</p>
				</blockquote>
			</div>
		</form>
		</div>
	</div>
</section>
<script type="text/javascript">
	CKEDITOR.replace('contentAns',{
		height:300,
		filebrowserUploadUrl:"<?php echo base_url();?>contentManagement/uploadContentController/uploadContentImages",
		filebrowserUploadMethod: 'form'
	})

</script>
<script type="text/javascript">
	function getTopicQuestions(){
		var topic = document.getElementById('topic').value;
		$.ajax({
	            type:'GET',
	            url:'<?php echo base_url("contentManagement/getQuestions/relatedQuestionFromTopicDashboard/"); ?>'+topic,
	            success:function(data){ 
	            	$("#relatedQuestionBox").html(data);	
	            },
	            error:function(data){
	            	$("#relatedQuestionBox").html("No Questions Found");
	            }
	        });
		}
</script>