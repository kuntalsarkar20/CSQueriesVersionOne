<section style="padding:80px 0px;">
	<div class="container">
		<?php
		  if($this->uri->segment(2)=="UploadFailed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Upload Failed</strong> Please check you have properly entered a title and Selected a Topic.
			  </div>';
		  }
		  ?>
		<div class="row">
			<form method="post" action="<?php echo base_url();?>contentManagement/uploadContentController/contentUploadUser">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label for="psw">Select any Topic</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <select class="form-control" id="topic" name="category" onchange="getTopicQuestions()" required>
				        <option selected="true" value='' disabled="disabled">Select Topic</option>
				        <?php 
					        foreach ($category as $row) {
								echo '<option value="'.$row['CategoryId'].'" id="topicName'.$row['CategoryId'].'">'.$row['Category'].'</option>';
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
			        <textarea class="form-control" rows="10" id="contentHeading" name="contentName" required></textarea> 
			      </div>
			  	</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12"><h4 style="font-weight: bold;">Already Uploaded Questions From this Topic</h4>
				<div style="height:310px;overflow: scroll;border: 2px solid black;" id="relatedQuestionBox">
				<p style="text-align: center;">Select a topic to view Questions</p>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Your Content Explaination/Answer</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="5" id="contentAns" name="contentDetails"></textarea>
			      </div>
			  	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Tags/Keywords for your Content(You can add Multiple tags):</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <input type="text" value="CSQueries" data-role="tagsinput" name="contentTags">
			      </div>
			  	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
			  	<!-- <p style="padding-left: 30px;">Auto Saved(Not Published)</p> -->
			  	<br>
			  	<button type="submit" name="publish" class="btn btn-success btn-md" id="upload-btn" style="float:right;margin-left:20px;" title="It will  be published and anyone can able to view this.">Save & Publish</button>
			  	<button type="submit"  name="save" class="btn btn-primary btn-md" id="upload-btn" style="float:right;right: 5px;" title="It will not be published until you publish it.">Save</button>
			</div>
		</form>
		<div class="col-lg-12 col-md-12 col-sm-12">
			<p>&nbsp;</p>
				<blockquote>
					<h4 style="font-weight: bold;">About Tags:</h4>
					<p style="font-size: 17px;"><strong>Tags or Keywords</strong> helps you to find your question easily. It also determines how your content will be ranked in the search results. Using proper tags is neccessary. You can add upto 50 tags. Choose them wisely. Tags can contain short forms of words or how the user will search your content.</p>
					<h4 style="font-weight: bold;">Note:</h4>
				    <ul>
				    	<li style="font-size: 15px;"><strong>Save</strong> Button will only save Content. Your content will not be Published. No one except you can view it. You can view your questions in <strong>My Contents</strong> located in Navigation Bar.</li>
				    	<li style="font-size: 15px;"><strong>Save & Publish:</strong>It means your content will be saved and published too.</li>
				    </ul>
				</blockquote>
			</div>
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
		// var id = 'topicName'+topic;
		// var topicval = document.getElementById(id).innerHTML;
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