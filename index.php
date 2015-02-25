<?php

include_once "include/top.php";

$englishDay = date("l", strtotime(trim(Input::get('date'))));





$days = array();
$days['Monday'] = 'Måndag';
$days['Tuesday'] = 'Tisdag';
$days['Wednesday'] = 'Onsdag';
$days['Thursday'] = 'Torsdag';
$days['Friday'] = 'Fredag';
$days['Saturday'] = 'Lördag';
$days['Sunday'] = 'Söndag';

$day = $days[$englishDay];
$week = (int)date("W", strtotime(trim(Input::get('date'))));


if(Input::exists()) {

	$db = DB::getInstance();

	$name = trim(Input::get('nameHidden'));
	$activity = trim(Input::get('activityHidden'));
	$minutes = trim(Input::get('minutes'));


	if(!(empty($name)) && !(empty($activity)) && preg_match('{^[0-9]{1,6}$}',$minutes) && $minutes > 0) {
		$db->query("insert into Timereports(name, activity, week, day, minutes) values ('" . $name . "', '" . $activity . "', " . $week . ", '" . $day . "', " . $minutes . ")");
		if(!$db->error()) {
			echo $messages['success'] . "Sparat" . $messages['end']; 
		} else {
			$result = $db->query("select * from Timereports where name = '" . $name . "' and activity = '" . $activity . "' and week = " . $week . " and day = '" . $day . "'");
			$tuple = $result->first();
			$updateMinutes = $tuple->minutes + $minutes;
			$db->query("update Timereports set minutes = " . $updateMinutes . " where name = '" . $name . "' and activity = '" . $activity . "' and week = " . $week . " and day = '" . $day . "'");
			echo $messages['success'] . "Aktiviteten fanns redan, totaltid uppdaterad" . $messages['end']; 

		}
	} else {
		echo $messages['danger'] . "Du missade ett fält" . $messages['end']; 
	}



}
?>

<div class="row">
	<div class="col-sm-6">
		<h1>Tidrapportering</h1>
		<h3></h3>
	</div>
</div>

<br>
<form method="POST">
	<div class="row form-group">
		<div class="col-sm-3">
			<div class="col-sm-3">
				<label>Namn</label>
			</div>
			<div class="col-sm-6">
				<div class="btn-group" style="width:100%;">
					<button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown" name="nameButton" id="nameButton"> 
						<?php 

						$names = trim(Input::get('nameHidden'));
						if(empty($names)) { 
							echo 'Namn <span class="caret"></span>';
						} else {
							echo $names . "   <span class='caret'></span>";
						};
						?>
					</button>
					<ul class="dropdown-menu" role="menu" ID="names">
						<?php			
						$db = DB::getInstance();
						$names = $db->query("select name from Names");
						foreach($names->results() as $name){
							echo "<li><a href='#'> " .$name->name . "</a></li>";
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row form-group">
		<div class="col-sm-3">
			<div class="col-sm-3">
				<label>Aktivitet</label>
			</div>
			<div class="col-sm-6">
				<div class="btn-group" style="width: 100%;">
					<button type="button" class="btn btn-block dropdown-toggle" data-toggle="dropdown" name="activityButton" id="activityButton"> 
						<?php 

						$activity = trim(Input::get('activityHidden'));
						if(empty($activity)) { 
							echo 'Aktivitet <span class="caret"></span>';
						} else {
							echo $activity . "   <span class='caret'></span>";
						};
						?>
					</button>
					<ul class="dropdown-menu" role="menu" ID="activities">
						<?php			
						$db = DB::getInstance();
						$activities = $db->query("select activity from Activities");
						foreach($activities->results() as $activity){
							echo "<li><a href='#'> " .$activity->activity . "</a></li>";
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div class="col-sm-3">
				<label>Tidslängd</label>
			</div>
			<div class="col-sm-6">
				<input style="width: 100%; line-height: 25px; text-align: center;" type="text" name="minutes" id="minutes" placeholder="Antal minuter" value="<?php echo Input::get('minutes');?>">
			</div>
		</div>
	</div>
	<div class="row" style="padding-top: 20px;">
		<div class="col-sm-3">
			<div class="col-sm-3">
				<label>Datum</label>
			</div>
			<div class="col-sm-6">
				<div id="date" class="input-append date" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd">
				    <input style="width: 100%; line-height: 25px; text-align: center;" id="date" name="date" size="16" type="text" value="<?php echo date('Y-m-d'); ?>"/>
				</div>
			</div>
		</div>
	</div>
	

	<br>
	<div class="col-sm-2">
		<button style="width: 107%" type="submit" class="btn btn-default">Spara</button>
	</div>

	<input type="hidden" id="activityHidden" name="activityHidden" value="<?php echo Input::get('activityHidden');?>">
	<input type="hidden" id="nameHidden" name="nameHidden" value="<?php echo Input::get('nameHidden');?>">
		
</form>

<br>

<script>
document.getElementById('tidrapportering').setAttribute( "class", "active" );
</script>
<script src="js/javascript.js"></script>


<script>
    $(document).ready(function() {
        $("#date input").datepicker({
        	format: 'yyyy-mm-dd',
     		weekStart: 1
        });
    });
</script>



<?php

include_once "include/bottom.php";

?>