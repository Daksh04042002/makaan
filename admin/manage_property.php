<?php
require('top.inc.php');
$pro_name='';
$pro_price='';
$pro_location='';
$pro_size='';
$pro_no_bed='';
$pro_no_bath= '';
$pro_agent_number='';
$image='';
$msg='';
$order_no=0;
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$image_required='';
	$res=mysqli_query($con,"select * from property_details where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$pro_name=$row['pro_name'];
		$pro_price=$row['pro_price'];
		$pro_location=$row['pro_location'];
		$pro_size=$row['pro_size'];
		$pro_no_bed=$row['pro_no_bed'];
		$pro_no_bath=$row['pro_no_bath'];
		$pro_agent_number=$row['pro_agent_number'];
		$image=$row['image'];
	}else{
		header('location:property.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$pro_name=get_safe_value($con,$_POST['pro_name']);
	$pro_price=get_safe_value($con,$_POST['pro_price']);
	$pro_location=get_safe_value($con,$_POST['pro_location']);
	$pro_size=get_safe_value($con,$_POST['pro_size']);
	$pro_no_bed=get_safe_value($con,$_POST['pro_no_bed']);
	$pro_no_bath=get_safe_value($con,$_POST['pro_no_bath']);
	$pro_agent_number=get_safe_value($con,$_POST['pro_agent_number']);
	
	if(isset($_GET['id']) && $_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	$msg="";
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PROPERTY_IMAGE_SERVER_PATH.$image);
				//imageCompress($_FILES['image']['tmp_name'],PROPERTY_IMAGE_SERVER_PATH.$image);
				mysqli_query($con,"update property_details set pro_name='$pro_name',pro_price='$pro_price',pro_location='$pro_location',pro_size='$pro_size',pro_no_bed='$pro_no_bed',pro_no_bath='$pro_no_bath',pro_agent_number='$pro_agent_number',image='$image' where id='$id'");
			}else{
				mysqli_query($con,"update property_details set pro_name='$pro_name',pro_price='$pro_price',pro_location='$pro_location',pro_size='$pro_size',pro_no_bed='$pro_no_bed',pro_no_bath='$pro_no_bath',pro_agent_number='$pro_agent_number'  where id='$id'");
			}
		}else{
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PROPERTY_IMAGE_SERVER_PATH.$image);
			//imageCompress($_FILES['image']['tmp_name'],PROPERTY_IMAGE_SERVER_PATH.$image);
			mysqli_query($con,"insert into property_details(pro_name,pro_price,pro_location,pro_size,image,status,pro_no_bed,pro_no_bath,pro_agent_number) values('$pro_name','$pro_price','$pro_location','$pro_size','$image','1','$pro_no_bed','$pro_no_bath','$pro_agent_number')");
		}
		header('location:property.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Property</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   <div class="form-group">
									<label for="heading1" class=" form-control-label">Property Name</label>
									<input type="text" name="pro_name" placeholder="Enter Property Name" class="form-control" required value="<?php echo $pro_name?>">
								</div>
								<div class="form-group">
									<label for="heading2" class=" form-control-label">Property Price</label>
									<input type="text" name="pro_price" placeholder="Enter Property Price" class="form-control" required value="<?php echo $pro_price?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Property Location</label>
									<input type="text" name="pro_location" placeholder="Enter Property Location" class="form-control" value="<?php echo $pro_location?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Property Size</label>
									<input type="text" name="pro_size" placeholder="Enter Property Size (please the measuring scale as well)" class="form-control" value="<?php echo $pro_size?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Number of Bed Rooms</label>
									<input type="number" name="pro_no_bed" placeholder="No. of bed rooms" class="form-control" value="<?php echo $pro_no_bed?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Number of Bath Rooms</label>
									<input type="number" name="pro_no_bath" placeholder="No. of bath rooms" class="form-control" value="<?php echo $pro_no_bath?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Enter Agent Contact Number</label>
									<input type="text" name="pro_agent_number" placeholder="Enter Agent Contact Number" class="form-control" value="<?php echo $pro_agent_number?>">
								</div>
								<div class="form-group">
									<label for="heading1" class=" form-control-label">Image</label>
									<input type="file" name="image" placeholder="Enter image" class="form-control" <?php echo  $image_required?> value="<?php echo $image?>">
									<?php
										if($image!=''){
echo "<a target='_blank' href='".PROPERTY_IMAGE_SITE_PATH.$image."'><img width='150px' src='".PROPERTY_IMAGE_SITE_PATH.$image."'/></a>";
										}
										?>
								</div>
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
<?php
require('footer.inc.php');
?>