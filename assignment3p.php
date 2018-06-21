
 <?php
$cxn = new mysqli("warehouse.cims.nyu.edu", 
		"mmj301", 
		"eakmf387", 
		"mmj301_mmj301_sqldatabase");

print($cxn->connect_error);

$queryCauseSpecified = "SELECT * from accident_data WHERE cause not like '%Unspecified%' AND injured>1 order by injured desc LIMIT 10; ";
$resultCauseSpecified = $cxn->query($queryCauseSpecified);

$queryPedsInjuredMoreThanOne = "SELECT* from accident_data WHERE pedestrians_injured>1;";
$resultPedsInjuredMoreThanOne = $cxn->query($queryPedsInjuredMoreThanOne);

$queryCount = "SELECT COUNT(id) AS num FROM accident_data;";
$resultCount = $cxn->query($queryCount);

$queryInjuredMoreThan2 = "SELECT * FROM accident_data WHERE injured>2 order by injured asc;";
$resultInjuredMoreThan2 = $cxn->query($queryInjuredMoreThan2);

$queryInjuredInManhattan = "SELECT * FROM accident_data WHERE injured>2;";
$resultInjuredInManhattan = $cxn->query($queryInjuredInManhattan);

$queryAlcohol = "SELECT * FROM accident_data WHERE injured>2;";
$resultAlcohol = $cxn->query($queryAlcohol);

$queryAverageInjured = "SELECT borough, AVG(injured) as avg from accident_data GROUP BY borough desc;";
$resultAverageInjured = $cxn->query($queryAverageInjured);

$queryThreeCols = "SELECT injured, pedestrians_injured, cause from accident_data where 1 order by injured desc LIMIT 10;";
$resultThreeCols = $cxn->query($queryThreeCols);

$queryUserFriendly= "SELECT id, created,cause, borough, injured, pedestrians_injured, killed from accident_data where 1 order by cause asc LIMIT 15;";
$resultsUserFriendly = $cxn->query($queryUserFriendly);

 print($cxn->error);
 
?>


<!doctype html>
 <html>
 	<head>
 		<link rel="stylesheet" type="text/css" href="styleHw3.css">
 		<title>Homework 3</title >
 	</head>
 	<body>
 	<center>
 			<h1>
 				ACCIDENTS IN NEW YORK
 			</h1>

	 		<div class="art1">
	 			
	 				<br>
	 				<p>The data I have used shows car accidents in New York's boroughs. It shows how many people died, the cause of the accident and if any civilians were killed 
	 				</p>
	 					I found this data interesting because I have not seen any serious accidents in Manhattan therefore I thought that the data would give a good understanding of the number of occurances of accidents. Also I found it interesting to know the number of accidents because of the number of city bikes, bars etc.
	 				
	 				<br>
	 				<p>
	 				

	 				</p>
	 				<a href="https://data.cityofnewyork.us/Public-Safety/NYPD-Motor-Vehicle-Collisions/h9gi-nx95">Link to where I found my data</a><br>
	 		</div>

 			<br>
 			<br>
 			<h2> ACCIDENT DATA TABLE Structure</h2>
		 			<table>
						  <tr>
							<th>Field</th>
							<th>Data Type</th> 
								  
						  </tr>
						  <tr>
						    <td>id</td>
						    <td>Int(11)</td> 
						  </tr>
						    <tr>
						    <td>Created</td>
						    <td>Timestamp</td> 
						  </tr>
						    <tr>
						    <td>Borough</td>
						    <td>Varchar(50)</td> 
						  </tr>
						    <tr>
						    <td>Killed</td>
						    <td>Int(3)</td> 
						  </tr>
						    <tr>
						    <td>Injured</td>
						    <td>Int(3)</td> 
						  </tr>
						    <tr>
						    <td>Pedestrians Injured</td>
						    <td>Int(3)</td> 
						  </tr>
						    <tr>
						    <td>Cause</td>
						    <td>Varchar(100)</td> 
						  </tr>
					</table>
	</center>
			<p>
				For the id field Int(11) was used, the 11 was for the display width to encompas a larger id number. For the created field, the timestamp was used, this will have no effect for my data because everything was imported around the same time. For the Borough field, a varchar of length 15 was used to enompass for the largest borough. For the next 3 fields, an integer with width 3 was used because there would be no vehicular accidents with the injury being more than a 3 digit number. For the cause, a varchar(100) was used because this description may contain more than words and may be longer therefore a maximum of 100 characters was allowed.
			</p>

			<br>
			<br>
			<br>

			<center><h1>QUERIES</h1></center>


			<p>(Number 1 from assignment page)</p>
			<?php while ($row = $resultCount->fetch_assoc()) : ?>

					<p class="num_results">
						Found 
						<?php print($row['num']); ?> 
						items in the database
					</p>

			<?php endwhile; ?>
			<br>
			<br>
			<br>

			<center>
			<p> (Number 3 from assignment page). The following shows three columns with the data in descending order by total people injured</p>
			
			<table>
				<th>Total People Injured</th>
				<th>Pedestrians Injured</th> 
			 	<th>Cause of Accident</th> 
					<?php while ($row = $resultThreeCols->fetch_assoc()) : ?>
											<tr>
												<td><?php print($row['injured']); ?></td>
												<td><?php print($row['pedestrians_injured']); ?></td>
												<td><?php print($row['cause']); ?></td>
												
											</tr>
					<?php endwhile; ?> 
			</table>
			</center>
				<br>
				<br>
				<br>

			<center>
			<p> (Number 4 from assignment page)The following shows the average number of people injured in each borough:</p>
			
			<table>
				<th>BOROUGH</th>
				<th>AVERAGE</th> 
			 
					<?php while ($row = $resultAverageInjured->fetch_assoc()) : ?>
											<tr>
												<td><?php print($row['borough']); ?></td>
												<td><?php print($row['avg']); ?></td>
										
												
											</tr>
					<?php endwhile; ?> 
			</table>
			</center>
				<br>
				<br>
				<br>

			<p> (Number 5 from assignment page)The following shows a user friendly listing of the first 15 items in the table sorted in ascending order by cause(I assumed user friendly meant a nice readable senetence format)</p>
			<?php while ($row = $resultsUserFriendly->fetch_assoc()) : ?>
								<p>
									Accident listing 
									<?php print($row['id']); ?> which was created on 
									<?php print($row['created']); ?> occured in 
									<?php print($row['borough']); ?>. A total of 
									<?php print($row['injured']); ?> people were injured,
									<?php print($row['pedestrians_injured']); ?> pedestrians were injured and
									<?php print($row['killed']); ?> peope were killed. The cause of the accident was due to "
									<?php print($row['cause']); ?> "
								</p>
			<?php endwhile; ?> 
			<br>
				<br>
				<br>












		<center>
		<p> The following shows the accidents where more than 2 people were injured:</p>
		
		<table>
			<th>BOROUGH</th>
			<th>INJURED</th> 
			<th>CAUSE</th> 
				<?php while ($row = $resultInjuredMoreThan2->fetch_assoc()) : ?>
										<tr>
											<td><?php print($row['borough']); ?></td>
											<td><?php print($row['injured']); ?></td>
											<td><?php print($row['cause']); ?></td>
										</tr>
				<?php endwhile; ?> 
		</table>
		</center>
			<br>
			<br>
			<br>

			<center>
		<p> The following shows the accidents where more than 1 pedestrian was injured:</p>
		
		<table>
			<th>BOROUGH</th>
			<th>INJURED</th> 
			<th>CAUSE</th> 
					<?php while ($row = $resultPedsInjuredMoreThanOne->fetch_assoc()) : ?>
										<tr>
											<td><?php print($row['borough']); ?></td>
											<td><?php print($row['injured']); ?></td>
											<td><?php print($row['cause']); ?></td>
										</tr>
					<?php endwhile; ?> 
		</table>
		</center>
			<br>
			<br>
			<br>


				<center>
			<p> The following shows the accidents where the cause of the accident was NOT unknown and where there were more than 1 person injured:</p>
			
		<table>
			<th>BOROUGH</th>
			<th>INJURED</th> 
			<th>CAUSE</th> 
					<?php while ($row = $resultCauseSpecified->fetch_assoc()) : ?>
										<tr>
											<td><?php print($row['borough']); ?></td>
											<td><?php print($row['injured']); ?></td>
											<td><?php print($row['cause']); ?></td>
										</tr>
					<?php endwhile; ?> 
		</table>
			<br>
			<br>
			<br>
			</center>


			<p> The following shows results where more than one person was injured and the accident occured in Manhattan. Also, the cause of the accident was not unknown:</p>
			<?php while ($row = $resultInjuredInManhattan->fetch_assoc()) : ?>
								<p>
									<?php print($row['injured']); ?> persons were injured due to 
									<?php print($row['cause']); ?>
								</p>
			<?php endwhile; ?> 
			<br>
			<br>
			<br>


			<p> The following shows results where alcohol use had some part to play in the accident:</p>
			<?php while ($row = $resultAlcohol->fetch_assoc()) : ?>
								<p>
									
									<?php print($row['borough']); ?> had 
									<?php print($row['injured']); ?> accidents because of alcohol involvement.
								</p>
			<?php endwhile; ?> 



			<center>
 			<footer>
 				<a href="index.html">Homepage</a><br>
 			</footer> 
 			</center>

 	
 		

 	
 	</body>
 </html>