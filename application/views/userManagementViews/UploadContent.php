<section style="padding:80px 0px;">
	<div class="container">
		<?php
		  if($this->uri->segment(2)=="UploadFailed"){
		    echo '<div class="alert alert-danger alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Upload Failed</strong> Please check you have properly entered a title and Selected a Topic.
			  </div>';
		  }else if($this->uri->segment(2)=="UploadSuccess"){
		  	echo '<div class="alert alert-success alert-dismissible fade in">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>Success!</strong> Your content is Uploaded Successfully.
			  </div>';
		  }
		  ?>
		<div class="row">
			<form method="post" action="<?php echo base_url();?>contentManagement/uploadContentController/contentUploadUser">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label for="psw">Select any Topic</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <select class="form-control" id="topic" name="category" required>
				        <option selected="true" value='' disabled="disabled">Select Topic</option>
				        <?php 
					        foreach ($category as $row) {
								echo '<option value="'.$row['CategoryId'].'">'.$row['CategoryName'].'</option>';
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
				<div style="height:310px;overflow: scroll;border: 2px solid black;">
				<?php 
				        foreach ($questions as $row) {
							echo '<div style="padding:10px 20px;"><b><a href="'.base_url().'questions/'.$row['CategoryName'].'/'.$row['ContentId'].'/'.$row['DashedQuestion'].'">'.$row['Question'].'</a></b></div>';
						}
					?>
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
			  	<!-- <p style="padding-left: 30px;">Auto Saved(Not Published)</p> -->
			  	<br>
			  	<button type="submit" name="publish" class="btn btn-success btn-md" id="upload-btn" style="float:right;margin-left:20px;" title="It will  be published and anyone can able to view this.">Save & Publish</button>
			  	<button type="submit"  name="save" class="btn btn-primary btn-md" id="upload-btn" style="float:right;right: 5px;" title="It will not be published until you publish it.">Save</button>
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
