<?php
/**
 * 
 * @author FABteam
 * @version 1.0
 * @license https://opensource.org/licenses/GPL-3.0
 * 
 */
?>

<script type="text/javascript">

	var temperaturesGraph;
	var mode = 'e';
	var showExtruderLines = true;
	var showBedLines = false;

	$(document).ready(function() {
		//~ jog_make_call_ajax ("get_temperature", "", readTemperaturesCallback);
		//~ if(running) tuning_interval = setInterval(readTuningInfo, 1000);
		//~ else interval_temperature = setInterval(readTemperatures, 1000);
		initGraph();
		disableButton('.save');
		$(".autotune").on('click', handleAutotuneAction);
		$(".save").on('click', saveToEEProm);
		$("#mode").on('change', changeMode);
	});

	/** init temperatures graph */
	function initGraph()
	{
		temperaturesGraph = $.plot("#temperatures-chart", getPlotTemperatures(), {
			series : {
				lines : {
					show : true,
					lineWidth : 1,
					fill : true,
					fillColor : {
						colors : [{
							opacity : 0.1
						}, {
							opacity : 0.15
						}]
					}
				}
			},
			xaxis: {
				mode: "time",
				show: true,
				tickFormatter: function (val, axis) {
					var d = new Date(val);
					return d.getHours() + ":" + d.getMinutes();
				},
				 timeformat: "%Y/%m/%d",
				 zoomRange: [1,100]
			},
			yaxis: {
				min: 0,
				max: 260,
				tickFormatter: function (v, axis) {
					return v + "&deg;C";
				},
			},
			tooltip : true,
			tooltipOpts : {
				content : "%s: %y &deg;C",
				defaultTheme : false
			},
			legend: {
				show : true
			},
			grid: {
				hoverable : true,
				clickable : true,
				borderWidth : 0,
				borderColor : "#efefef",
				tickColor :  "#efefef"
				
			},
			zoom:{
				interactive: false
			}
			
		});
		setInterval(updateGraph, 1000);
	}
	
	/**
	 * get plots for temperatures graph
	 */
	function getPlotTemperatures()
	{
		var seriesExtTemp   = [];
		var seriesExtTarget = [];
		var seriesBedTemp   = [];
		var seriesBedTarget = [];
		var data            = new Array();
		
		$.each( temperaturesPlot.extruder.temp, function( key, plot ) {
  			seriesExtTemp.push([plot.time, plot.value]);
		});
		$.each( temperaturesPlot.extruder.target, function( key, plot ) {
  			seriesExtTarget.push([plot.time, plot.value]);
		});
		$.each( temperaturesPlot.bed.temp, function( key, plot ) {
  			seriesBedTemp.push([plot.time, plot.value]);
		});
		$.each( temperaturesPlot.bed.target, function( key, plot ) {
  			seriesBedTarget.push([plot.time, plot.value]);
		});
		//extruder actual line
		if(showExtruderLines){
			data.push({
				data: seriesExtTemp,
				lines: { show: true, fill: true, lineWidth:0.5},
				label: "Ext temp",
				color: "#FF0000",
				points: {"show" : false}
			});
			//extruder target line
			data.push({
				data: seriesExtTarget,
				lines: { show: true, fill: false, lineWidth:2 },
				label: "Ext target",
				color: "#3276B1",
				points: {"show" : false}
			});
		}
		//bed actul line
		if(showBedLines){
			data.push({
				data: seriesBedTemp,
	      		lines: { show: true, fill: true, lineWidth:1},
	     	 	label: "Bed temp",
	     	 	color: "#FF0000",
	     	 	points: {"show" : false}
			});
		//bed target line
			data.push({
				data: seriesBedTarget,
				lines: { show: true, fill: false, lineWidth:2 },
	     	 	label: "Bed target",
	     	 	color: "#3276B1",
	     	 	points: {"show" : false}
			});
		}
		return data;
	}
	/**
	 * update graph
	 */
	function updateGraph()
	{
		var data = getPlotTemperatures();	
		if(typeof temperaturesGraph !== 'undefined' ){
			temperaturesGraph.setData(data);
			temperaturesGraph.draw();
			temperaturesGraph.setupGrid();	
		}
	}

	function handleAutotuneAction()
	{
		
	}
	
	function saveToEEProm()
	{
	}
		
	function changeMode()
	{
		setMode($(this).val());
	}

	
	function finalizePidTuning()
	{
		running = false;
		clearInterval(tuning_interval);
		//interval_temperature = setInterval(readTemperatures, 1000);
		enable_button('.save');
		$(".header-status").html('completed');
		$(".button-title").html('Start autotuning');
		$('.autotune').find('i').removeClass('fa-stop').addClass('fa-play');
		$('.autotune').attr('data-action', 'start');
		enableInputs();
	}
	
	function setMode(m)
	{
		mode = m;
		var max = 0;
		
		if(mode == 'e'){
			max = 250;
			showExtruderLines = true;
			showBedLines = false;
			var label = 'Extruder';
			
			
		}else if(mode == 'b'){
			max = 90;
			if($("#temperature_target").val() > max){
				$("#temperature_target").val(max);
			}
			showExtruderLines = false;
			showBedLines = true;
			var label = 'Bed';
		}
		$("#temperature_target").attr('max', max);
		$(".mode-label").html(label);
		$("#mode").val(mode);
	}
	
	function disableInputs()
	{
		$("#temperature_target").attr('readonly', 'readonly');
		$("#cycle").attr('readonly', 'readonly');
		disable_button("#mode");
	}
	
	function enableInputs()
	{
		$("#temperature_target").removeAttr('readonly');
		$("#cycle").removeAttr('readonly');
		enable_button("#mode");
	}

</script>
