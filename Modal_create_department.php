
<div class="modal fade" id="newDepartmentModal" tabindex="-1" role="dialog" aria-hidden="true" style="margin-top:100px;">
	<div class="modal-dialog" style="width:40%; max-width:60%;">
		<form action="#" method="post">
			<div class="modal-content">
				<div class="modal-header" style="background-color:chocolate;color:white;">
						<h1 class="text-center" style=" margin-top:10%">Create Department</h1>
				</div>

				<div class="modal-body">
					
					<div class="form-group">
						<span id="member_department"></span>
						<input type="text" value="" name="member_dep" id="member_dep" class="form-control hidden">
					</div>
					<div class="form-group">
						<label>Department</label>
						<?php
							$mb->selectdepart();
						?>
					</div>
				</div>
				<div class="modal-footer">
					<button  type="submit" name="create_department" class="btn btn-success">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</form>
		
		
	</div>
</div>
<?php
 
		if(isset($_POST['create_department']) and isset($_POST['member_dep']) and isset($_POST['depart']))
		{
			$mb->createdepartment_members($_POST['member_dep'], $_POST['depart']);
			echo '<script>history.back(); </script>';
		}
		
?>