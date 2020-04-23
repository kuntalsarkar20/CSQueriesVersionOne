<?php
include "Header.php";
?>
<section style="padding:80px 0px;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label for="psw">Select any Topic</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <select class="form-control" id="sel1">
				        <option>DBMS</option>
				        <option>DS & Algorithm</option>
				        <option>C</option>
				        <option>C++</option>
				      </select>
			      </div>
			      <h5 style="float: right;padding-right: 30px;">Topic not listed?<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --></h5>
			  	</div>
			  	<p>&nbsp;</p>
			  	<label for="psw">Your Content Heading/Question</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="5" id="comment" name="cmnt" required></textarea>
			      </div>
			  	</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12"><h4>Already Uploaded Questions From this Topic</h4>
				<div style="height:310px;overflow: scroll;">
					The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.The overflow property specifies whether to clip content or to add scrollbars when an element's content is too big to fit in a specified area.
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p>&nbsp;</p>
			  	<label for="psw">Your Content Explaination/Answer</label>
			    <div class="form-group">
			      <div class="col-sm-12">
			        <textarea class="form-control" rows="5" id="contentAns" name="cmnt" required></textarea>
			      </div>
			  	</div>
			  	<p>&nbsp;</p>
			  	<button type="button" class="btn btn-primary btn-lg" style="float:right;">Upload</button>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	CKEDITOR.replace('comment', {
  	height: 100
});
	CKEDITOR.replace('contentAns')
</script>
<?php
include "Footer.php";
?>