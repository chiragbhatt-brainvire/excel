<?php
include 'db.php';

$select_sql = "SELECT * FROM user";
$select_result = mysqli_query($conn, $select_sql);

$row_count = mysqli_num_rows($select_result);


if(isset($_POST["Import"])){
		
		if($row_count > 0){
			$delete_sql = "TRUNCATE TABLE user";
			$delete_result = mysqli_query($conn, $delete_sql);
		}

		if($delete_result){
			
			echo $filename=$_FILES["file"]["tmp_name"];
		

			 if($_FILES["file"]["size"] > 0)
			 {

			  	$file = fopen($filename, "r");
		         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
		         {
			        $sql = "INSERT INTO user(first_name,last_name,mobile,email,address,city,country,birth_date,gender,
			        university_name,enrollment_no) 
			      	
			      	VALUES ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]',
			      	'$emapData[6]','$emapData[7]','$emapData[8]','$emapData[9]','$emapData[10]')";
		
		          	$result = mysqli_query($conn, $sql);
					
					if(! $result )
					{
						echo "<script type=\"text/javascript\">
								alert(\"Invalid File:Please Upload CSV File.\");
								window.location = \"index.php\"
							</script>";
					
					}

		         }
		         fclose($file);
		         //throws a message if data successfully imported to mysql database from excel file
		         echo "<script type=\"text/javascript\">
							alert(\"CSV File has been successfully Imported.\");
							window.location = \"index.php\"
						</script>";
		        
				mysqli_close($conn); 
				
			 }
		}
	}	 
?>		 