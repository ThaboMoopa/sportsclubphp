<?php   
   include('index.html');   
?>
<html>   
<head>      
  <?php echo "<link rel='stylesheet' type='text/css' href='css/styles.css' />";?> 
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="table.js"></script>
</head>	
   <body> 
      <div align="center">
		<table align="center" class="hoverTable">	 
			<tr>
				<th>Member ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Designation</th>
				<th>DOB</th>
				<th>Status</th>
			</tr>				
         <?php            
			if (isset($_POST['view']) )
			{	
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_PORT => "8080",
				  CURLOPT_URL => "http://localhost:8080/Controller/allAdministrator",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
												"authorization: Basic dXNlcjpwYXNzd29yZA==",
												"cache-control: no-cache",
												'Content-Type: application/json',
												'Accept: application/json'
											  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);			
				curl_close($curl);				

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {	
					
					$characters = json_decode($response);
					foreach ($characters as $res) {
						if($res->status == 'active'){
							echo '<tr>';
							echo '<td>' . $res->clubID . '</td>';
							echo '<td>' . $res->firstName . '</td>';
							echo '<td>' . $res->lastName . '</td>';
							echo '<td>' . $res->designation . '</td>';
							echo '<td>' . $res->dob . '</td>';
							echo '<td>' . $res->status . '</td>';
							echo '</tr>';
						}
					}		
				}
			}			
         ?>		
		 </table>
      </div>       
      <div class= "container-fluid" align="center" >      
         <form class = "form-signin" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
			<h3 style="margin-top:10px;">All Admins</h3>
			<br clear="both"> 
				<button class = "btnSubmit" type = "submit" name = "view">View Admins</button>
         </form> 		 
      </div>	  
</body>
</html>































