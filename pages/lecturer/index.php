<?php 
if (logged_in() ===  TRUE) {
  $userdata = getUserDataByUserId($_SESSION['id']);
  $user_role = $userdata['user_role'];

  if ($user_role != '3')
  { 
    $link = $linkdomain."/portalmahasiswa/index.php?page=error";
      // $link = $linkdomain."/index.php?page=error";
    
      echo '<script type="text/javascript">
          window.location = "'.$link.'"
      </script>';
  }
  
}
if (logged_in() === FALSE) {
  $link = $linkdomain."/portalmahasiswa/index.php?page=error";
    // $link = $linkdomain."/index.php?page=error";
  
    echo '<script type="text/javascript">
        window.location = "'.$link.'"
    </script>';
}

 ?>
<div class="px-4 py-4">
	
	<h5 class="simple-text text-center"><i class="fas fa-clipboard-list"></i> Manage Lecturer</h5>

	<?php 
	if (isset($_GET['status'])) {
	  if ($_GET['status'] == "successadd") {
	    echo "<div class='alert alert-success text-center'>Successfully Add Lecturer</div>";
	  }
	  elseif ($_GET['status'] == "successdelete") {
	    echo "<div class='alert alert-success text-center'>Successfully Change Lecturer Status</div>";
	  }
	  elseif ($_GET['status'] == "successedit") {
	    echo "<div class='alert alert-success text-center'>Successfully Edit Lecturer</div>";
	  }

	}
	?>

	<form action="" method="POST">
	    <div class="input-group mb-3">
	        <div class="input-group-prepend">
	          <label class="input-group-text" for="inputGroupSelect01">Study Program</label>
	        </div>
	        <select class="custom-select" id="inputGroupSelect01" name="studyprogram_opt">
	        <option selected>Choose...</option>

	        <?php
	            $result = getAllStudyProgram();

	            if ($result != false) 
	            {
	              while ($row = $result->fetch_assoc()) 
	              {
	                $studyprogram_id = $row['studyprogram_id'];
	                $studyprogram_name = $row['studyprogram'];
	              
	          ?>

	          <option value="<?php echo $studyprogram_id; ?>"><?php echo $studyprogram_name; ?></option>

	          <?php        
	              }
	            }
	          ?>

	          <option value="all">All</option>

	        </select>

	        <div class="input-group-prepend">
	          <button class="input-group-text bg-secondary text-white" for="inputGroupSelect01" type="submit">Go</button>
	        </div>

	      </div>
      </form>

	
      <p class="text-right mr-4"><i class="far fa-square bg-warning"></i> Inactive  <i class="far fa-square"></i> Active</p>


	<table class="table table-responsive-lg text-center table-bordered">
	  	<thead class="thead-light">
	    	<tr>
	      		<th scope="col">Lecturer ID</th>
	      		<th scope="col">Name</th>
	      		<th scope="col">Study Program</th>
	      		<th scope="col">Tools</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	    	
    		<?php 

    		if (isset($_POST['studyprogram_opt'])) {
    			$id = $_POST['studyprogram_opt'];
    			$result = getAllLecturerByStudyProgram($id);

    			if ($result != false) {
    				while ($row = $result->fetch_assoc()) {
    					$id = $row['id'];
    					$lecturer_id = $row['lecturer_id'];
        				$name = $row['name'];
        				$studyprogram = $row['studyprogram'];
        				$status = $row['status'];


        				if ($status == '2') {
							echo "<tr class='bg-warning'>";
						} else {
							echo "<tr>";
						}	

			?>

	      		<td><?php echo $lecturer_id; ?></td>
	      		<td><?php echo $name; ?></td>
	      		<td><?php echo $studyprogram; ?></td>
	      		<td style="width: 30%;">
	      			<a href="<?php echo $baseUrl.'index.php?page=detaillecturer&id='.$id.''; ?>" class="badge badge-12 badge-secondary">Detail <i class="fas fa-user"></i></a> &nbsp;
	      			<a href="<?php echo $baseUrl.'index.php?page=editlecturer&id='.$id.''; ?>" class="badge badge-12 badge-primary">Edit <i class="fas fa-edit"></i></a> &nbsp;

	      			<?php 
				      	if ($status == '2') {
							
						?>
							<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-danger">Inactive <i class="fas fa-exclamation-circle"></i></a>
						<?php } else { ?>
							<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-success">Active <i class="far fa-check-square"></i></a>
						<?php } ?>
	      			
	      		</td>
	      	</tr>



			<?php
    				}
    			} 
    			if ($_POST['studyprogram_opt'] == 'all') {
	    			$result = getAllLecturerData();

	    			if ($result != false) {
	    				while ($row = $result->fetch_assoc())
	    				{	
	    					$id = $row['id'];
	    					$lecturer_id = $row['lecturer_id'];
	        				$name = $row['name'];
	        				$studyprogram = $row['studyprogram'];
	        				$status = $row['status'];


	        				if ($status == '2') {
								echo "<tr class='bg-warning'>";
							} else {
								echo "<tr>";
							}		
    				
    		?>
				      		<td><?php echo $lecturer_id; ?></td>
				      		<td><?php echo $name; ?></td>
				      		<td><?php echo $studyprogram; ?></td>
				      		<td style="width: 30%;">
				      			<a href="<?php echo $baseUrl.'index.php?page=detaillecturer&id='.$id.''; ?>" class="badge badge-12 badge-secondary">Detail <i class="fas fa-user"></i></a> &nbsp;
				      			<a href="<?php echo $baseUrl.'index.php?page=editlecturer&id='.$id.''; ?>" class="badge badge-12 badge-primary">Edit <i class="fas fa-edit"></i></a> &nbsp;

				      			<?php 
							      	if ($status == '2') {
										
									?>
										<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-danger">Inactive <i class="fas fa-exclamation-circle"></i></a>
									<?php } else { ?>
										<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-success">Active <i class="far fa-check-square"></i></a>
									<?php } ?>
				      			
				      		</td>
				      	</tr>

    		<?php
	    					}
			    		} else {
		    				echo "<div class='alert alert-danger text-center'>No Lecturers Data</div>";
		    			}

    				}
    			} else {
	    			$result = getAllLecturerData();

	    			if ($result != false) {
	    				while ($row = $result->fetch_assoc())
	    				{	
	    					$id = $row['id'];
	    					$lecturer_id = $row['lecturer_id'];
	        				$name = $row['name'];
	        				$studyprogram = $row['studyprogram'];
	        				$status = $row['status'];


	        				if ($status == '2') {
								echo "<tr class='bg-warning'>";
							} else {
								echo "<tr>";
							}		
        	 ?>
			        	 
				      		<td><?php echo $lecturer_id; ?></td>
				      		<td><?php echo $name; ?></td>
				      		<td><?php echo $studyprogram; ?></td>
				      		<td style="width: 30%;">
				      			<a href="<?php echo $baseUrl.'index.php?page=detaillecturer&id='.$id.''; ?>" class="badge badge-12 badge-secondary">Detail <i class="fas fa-user"></i></a> &nbsp;
				      			<a href="<?php echo $baseUrl.'index.php?page=editlecturer&id='.$id.''; ?>" class="badge badge-12 badge-primary">Edit <i class="fas fa-edit"></i></a> &nbsp;

				      			<?php 
							      	if ($status == '2') {
										
									?>
										<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-danger">Inactive <i class="fas fa-exclamation-circle"></i></a>
									<?php } else { ?>
										<a href="<?php echo $baseUrl.'pages/lecturer/status.php?id='.$id.'&stdstts='.$status.''; ?>" class="badge badge-12 badge-success">Active <i class="far fa-check-square"></i></a>
									<?php } ?>
				      			
				      		</td>
				      	</tr>
      		<?php
	    				
	    			}
	    		}
	    	}

    		 ?>
	    	

	  	</tbody>
	</table>

	<div class="text-right my-4">
		<a href="<?php echo $baseUrl.'index.php?page=addlecturer'; ?>" class="btn btn-secondary">Add Lecturer</a>
	</div>


</div>