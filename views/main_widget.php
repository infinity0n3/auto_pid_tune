<?php
/**
 * 
 * @author 
 * @version 1.0
 * @license https://opensource.org/licenses/GPL-3.0
 * 
 */
?>

<div class="row">
	<div class="col-sm-6">
		<p class="margin-top-10" style="padding:10px">
			<span class=""> <i class="fab-lg fab-fw icon-fab-term "></i> <span class="mode-label">Extuder</span> <span class="spd-temperature"></span> &deg;C</span>
			
			 
			 <span class="pull-right" style="margin-left:10px;"> Max: <span class="spd-max"></span> &deg;C</span>
			 <span class="pull-right"> Min: <span class="spd-min"></span> &deg;C</span>
			
		</p>
		<div id="temperatures-chart" style="margin-top:0px;" class="chart"> </div>	
	</div>
	<div class="col-sm-6">
		<div class="smart-form">
			<!-- <header>Status: <span class="header-status"><?php echo isset($task) ? 'running' : 'stopped'; ?></span></header> -->
			<fieldset>
				<section>
					<label class="label">Mode</label>
					<label class="select">
						<select id="mode">
							<option value="e">Extruder</option>
							<option value="b">Bed</option>
						</select> <i></i>
					</label>
				</section>
				<div class="row">
					<section class="col col-6">
						<label class="label">Target temperature </label>
						<label class="input">
							<input type="number" max="250" value="200" id="temperature_target">
						</label>
					</section>
					<section class="col col-6">
						<label class="label">Cicle</label>
						<label class="input">
							<input type="number" value="8" id="cycle">
						</label>
					</section>
				</div>
				<div class="row tuning-values">
					<section class="col col-4">
						<label class="label">Kp</label>
						<label class="input"><input type="text" id="kp" readonly="readonly" /></label>
					</section>
					<section class="col col-4">
						<label class="label">Ki</label>
						<label class="input"><input type="text" id="ki" readonly="readonly" /></label>
					</section>
					<section class="col col-4">
						<label class="label">Kd</label>
						<label class="input"><input type="text" id="kd" readonly="readonly" /></label>
					</section>
				</div>
				
			</fieldset>
		</div>
	</div>
</div>
<div class="widget-footer">
	<div class="pull-left">
		<span class="label label-danger"><span class="mode-label">Extruder</span> temperature</span>
		<span class="label label-primary" style="">Target temperature</span>
	</div>
	<button data-action="<?php echo isset($task) ? 'stop' : 'start'; ?>" class="btn btn-sm btn-default  autotune"><i class="fa fa-<?php echo isset($task) ? 'stop' : 'play'; ?>"></i> <span class="button-title"><?php echo isset($task) ? 'Stop' : 'Start'; ?> Autotuning</span></button>
	<button data-action="save" class="btn btn-sm btn-default  save"><i class="fa fa-save"></i> Save to EEProm</button>
</div>
