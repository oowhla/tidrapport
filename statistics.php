<?php

include_once "include/top.php";

?>

<div class="row">
	<div class="col-sm-2">
		<h3>Namn</h3>
	</div>
	<div class="col-sm-2">
		<h3>Aktivitet</h3>
	</div>
	<div style="left:35px;" class="col-sm-2">
		<h3>Vecka</h3>
	</div>
</div>

<div class="row">
	<form method="POST">
		<div class="col-sm-2">
			<div class="row">
			  <div class="col-lg-10">
			    <div class="input-group">
			      <span class="input-group-addon">
					<input name='allNames' id='allNames' type='checkbox' value='allNames' checked>
				</span>
			      <label for='allNames' class="form-control" aria-label="...">Alla</label>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div>
	    <?php
			$db = DB::getInstance();
			$names = $db->query("select name from Names");
			foreach($names->results() as $name) {
				echo '<div class="row">
						  <div class="col-lg-10">
						    <div class="input-group">
						      <span class="input-group-addon">';
							echo "<input name='name[".$name->name."]' class='names' id='"  . $name->name . "' type='checkbox' value='"  . $name->name . "'>";
						echo ' </span>
						      <label class="form-control" for="' . $name->name . '" aria-label="...">' . $name->name . '</label>
						    </div><!-- /input-group -->
						  </div><!-- /.col-lg-6 -->
						</div>';
			}
		?>
			     
		</div>
		<div class="col-sm-2">
			<div class="row">
			  <div class="col-lg-10">
			    <div class="input-group">
			      <span class="input-group-addon">
					<input name='allActivities' id='allActivities' type='checkbox' value='allActivities' checked>
				</span>
			      <label for='allActivities' class="form-control" aria-label="...">Alla</label>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div>
			<?php
			$db = DB::getInstance();
			$activities = $db->query("select activity from Activities");
			foreach($activities->results() as $activity) {
				echo '<div class="row">
						  <div class="col-lg-10">
						    <div class="input-group">
						      <span class="input-group-addon">';
							echo "<input name='activity[".$activity->activity."]' class='activities' id='"  . $activity->activity . "' type='checkbox' value='"  . $activity->activity . "'>";
						echo ' </span>
						      <label class="form-control" for="' . $activity->activity . '" aria-label="...">' . $activity->activity . '</label>
						    </div><!-- /input-group -->
						  </div><!-- /.col-lg-6 -->
						</div>';
			}
			?>

		</div>
		<div style="left:35px;" class="col-sm-2">
			<div class="row">
			  <div class="col-lg-10">
			    <div class="input-group">
			      <span class="input-group-addon">
					<input name='allWeeks' id='allWeeks' type='checkbox' value='allWeeks' checked>
				</span>
			      <label for='allWeeks' class="form-control" aria-label="...">Alla</label>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div>
			<?php
			$db = DB::getInstance();
			$weeks = $db->query("select distinct(week) as week from Timereports order by week asc");
			foreach($weeks->results() as $week) {
				echo '<div class="row">
						  <div class="col-lg-10">
						    <div class="input-group">
						      <span class="input-group-addon">';
							echo "<input name='week[".$week->week."]' class='weeks' id='"  . $week->week . "' type='checkbox' value='"  . $week->week . "'>";
						echo ' </span>
						      <label class="form-control" for="' . $week->week . '" aria-label="...">' . $week->week . '</label>
						    </div><!-- /input-group -->
						  </div><!-- /.col-lg-6 -->
						</div>';
			}
			?>
		</div>
		
	</div>
	
	<div class="row">
		<div class="col-sm-2 col-sm-offset-4">
			<button style="width: 77%; margin-left:30px;" type="submit" class="btn btn-default">Generera statistik</button>
		</div>	
	</div>
	<hr style="margin-right:3%;">
	</form>
	<br>
	</div>

<?php
if(Input::exists()) {
	$db = DB::getInstance();

	$allNames = false;
	$allActivities = false;
	$allWeeks = false;

	$numberOfNames = 0;
	$numberOfActivities = 0;
	$numberOfWeeks = 0;

	$nameArray = array();
	$activityArray = array();
	$weekArray = array();


	if(Input::get('allNames')) {
		$allNames = true;
		$result = $db->query("select count(name) as numberOfNames from Names");
		$numberOfNames = $result->first()->numberOfNames;
		$result = $db->query("select name from Names");
		foreach($result->results() as $name) {
			array_push($nameArray, $name->name);
		}
		
	} else {
		foreach($_POST["name"] as $key => $name) {
			array_push($nameArray, $name);
			$numberOfNames = $numberOfNames + 1;
		}
	}

	if(Input::get('allActivities')) {
		$allActivities = true;
		$result = $db->query("select count(activity) as numberOfActivities from Activities");
		$numberOfActivities = $result->first()->numberOfActivities;
		$result = $db->query("select activity from Activities");
		foreach($result->results() as $activity) {
			array_push($activityArray, $activity->activity);
		}
	} else {
		foreach($_POST["activity"] as $key => $activity) {
			array_push($activityArray, $activity);
			$numberOfActivities = $numberOfActivities + 1;
		}
	}

	if(Input::get('allWeeks')) {
		$allWeeks = true;
		$result = $db->query("select count(distinct(week)) as numberOfWeeks from Timereports");
		$numberOfWeeks = $result->first()->numberOfWeeks;
		$result = $db->query("select distinct(week) as week from Timereports order by week asc");
		foreach($result->results() as $week) {
			array_push($weekArray, $week->week);
		}
	} else {
		foreach($_POST["week"] as $key => $week) {
			array_push($weekArray, $week);
			$numberOfWeeks = $numberOfWeeks + 1;
		}
	}

	$weekCount = 0;
	foreach($weekArray as $week) {
		if(!($weekCount % 3)) {
			echo "</div><div class='row'><div class='col-sm-10 col-sm-offset-2'>";
		}
		$weekCount++;
		?>
		<div class="col-sm-2">
			<table class="table table-bordered" style="table-layout:fixed;">
				<tr>
					<th colspan="2" style="text-align: center;">Vecka <?php echo $week; ?> </th>
				<tr>
					<th>Aktivitet</th>
					<th>Minuter</th>
				</tr>
				<?php
				if($allNames) {
					foreach($activityArray as $activity) {
						$minutes = 0;
						$result = $db->query("select sum(minutes) as minutes from Timereports where week=" . $week . " and activity='" . $activity . "'");
						if($result->first()->minutes != NULL) {
							$minutes = $result->first()->minutes;
						}
						echo '<tr><td>' . $activity . '</td><td>' . $minutes . ' </td>';
					}
				} else {
					$nameString = " and(";
					$nameCount = 0;
					foreach($nameArray as $name) {
						if($nameCount > 0) {
							$nameString = $nameString . " or name='" . $name . "'";
						} else {
							$nameString = $nameString . "name='" . $name . "'";
						}
						$nameCount++;						
					}
					$nameString = $nameString . ")";
					foreach($activityArray as $activity) {
						$result = $db->query("select sum(minutes) as minutes from Timereports where week=" . $week . " and activity='" . $activity . "'" . $nameString);
						$minutes = 0;
						if($result->first()->minutes != NULL) {
							$minutes = $result->first()->minutes;
						}
						echo '<tr><td>' . $activity . '</td><td>' . $minutes . ' </td>';
					}
				}
				?>
			</table>
		</div>
		<?php

	}
	if($numberOfWeeks > 1) {
		if($allWeeks) {
		?>
		<div class="col-sm-2">
			<table class="table table-bordered" style="table-layout:fixed;">
				<tr>
					<th colspan="2" style="text-align: center;">Totalt för valda veckor</th>
				<tr>
					<th>Aktivitet</th>
					<th>Minuter</th>
				</tr>
				<?php
				if($allNames) {
					foreach($activityArray as $activity) {
						$result = $db->query("select sum(minutes) as minutes from Timereports where activity='" . $activity . "'");
						echo '<tr><td>' . $activity . '</td><td>' . $result->first()->minutes . ' </td>';
					}
				} else {
					$nameString = " and(";
					$nameCount = 0;
					foreach($nameArray as $name) {
						if($nameCount > 0) {
							$nameString = $nameString . " or name='" . $name . "'";
						} else {
							$nameString = $nameString . "name='" . $name . "'";
						}
						$nameCount++;						
					}
					$nameString = $nameString . ")";
					foreach($activityArray as $activity) {
						$result = $db->query("select sum(minutes) as minutes from Timereports where activity='" . $activity . "'" . $nameString);
						$minutes = 0;
						if($result->first()->minutes != NULL) {
							$minutes = $result->first()->minutes;
						}
						echo '<tr><td>' . $activity . '</td><td>' . $minutes . ' </td>';
					}
				}
				?>
			</table>
		</div>
		<?php
	} else {
		?>
		<div class="col-sm-2">
			<table class="table table-bordered" style="table-layout:fixed;">
				<tr>
					<th colspan="2" style="text-align: center;">Totalt för valda veckor</th>
				<tr>
					<th>Aktivitet</th>
					<th>Minuter</th>
				</tr>
				<?php
				if($allNames) {
					$weekString = " and(";
					$weekCount = 0;
					foreach($weekArray as $week) {
						if($weekCount > 0) {
							$weekString = $weekString . " or week=" . $week;
						} else {
							$weekString = $weekString . "week=" . $week;
						}
						$weekCount++;						
					}
					$weekString = $weekString . ")";
					foreach($activityArray as $activity) {
						$result = $db->query("select sum(minutes) as minutes from Timereports where activity='" . $activity . "'" . $weekString);
						$minutes = 0;
						if($result->first()->minutes != NULL) {
							$minutes = $result->first()->minutes;
						}
						echo '<tr><td>' . $activity . '</td><td>' . $minutes . ' </td>';
					}
				} else {
					$weekString = " and(";
					$weekCount = 0;
					foreach($weekArray as $week) {
						if($weekCount > 0) {
							$weekString = $weekString . " or week=" . $week;
						} else {
							$weekString = $weekString . "week=" . $week;
						}
						$weekCount++;						
					}
					$weekString = $weekString . ")";
					$nameString = " and(";
					$nameCount = 0;
					foreach($nameArray as $name) {
						if($nameCount > 0) {
							$nameString = $nameString . " or name='" . $name . "'";
						} else {
							$nameString = $nameString . "name='" . $name . "'";
						}
						$nameCount++;						
					}
					$nameString = $nameString . ")";
					foreach($activityArray as $activity) {
						$result = $db->query("select sum(minutes) as minutes from Timereports where activity='" . $activity . "'" . $weekString . $nameString);
						$minutes = 0;
						if($result->first()->minutes != NULL) {
							$minutes = $result->first()->minutes;
						}
						echo '<tr><td>' . $activity . '</td><td>' . $minutes . ' </td>';
					}
				}
				?>
			</table>
		</div>
		<?php
		}
	}
	
}
?>



<script>
document.getElementById('statistik').setAttribute( "class", "active" );
</script>
<script src="js/javascript.js"></script>


<?php

include_once "include/bottom.php";

?>