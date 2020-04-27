<section style="padding:80px 0px;">
	<div class="container">
		<div class="row">
			<form method="post" action="contentManagement/uploadContentController/contentUploadUser">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label for="psw">Select any Topic</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <select class="form-control" id="sel1" name="category">
				        <option selected="true" disabled="disabled">Select Topic</option>
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
			        <textarea class="form-control" rows="5" id="comment" name="contentName" required></textarea>
			      </div>
			  	</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12"><h4 style="font-weight: bold;">Already Uploaded Questions From this Topic</h4>
				<div style="height:310px;overflow: scroll;border: 2px solid black;">
					
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Your Content Explaination/Answer</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="5" id="contentAns" name="contentDetails" required></textarea>
			      </div>
			  	</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
			  	<!-- <p style="padding-left: 30px;">Auto Saved(Not Published)</p> -->
			  	<br>
			  	<button type="submit" name="publish" class="btn btn-success btn-md" style="float:right;margin-left:20px;" title="It will  be published and anyone can able to view this.">Save & Publish</button>
			  	<button type="submit" name="save" class="btn btn-primary btn-md" style="float:right;right: 5px;" title="It will not be published until you publish it.">Save</button>
			</div>
		</form>
		</div>
	</div>
</section>
<script type="text/javascript">
	CKEDITOR.replace('comment', {
  	height: 100
});
	CKEDITOR.replace('contentAns')
</script>
