<?php
/**
 * 
 * @author 
 * @version 1.0
 * @license https://opensource.org/licenses/GPL-3.0
 * 
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Plugin_auto_pid_tune extends FAB_Controller {

	public function index()
	{
		$this->load->library('smart');
		$this->load->helper('form');
		$this->load->helper('fabtotum_helper');
		$this->load->helper('plugin_helper');
		
		$data = array();
		$data['task'] = 'stopped';
		
		$widgetOptions = array(
			'sortable'     => false, 'fullscreenbutton' => true,  'refreshbutton' => false, 'togglebutton' => false,
			'deletebutton' => false, 'editbutton'       => false, 'colorbutton'   => false, 'collapsed'    => false
		);
		
		$widgeFooterButtons = '';

		$widget         = $this->smart->create_widget($widgetOptions);
		$widget->id     = 'main-widget-head-installation';
		$widget->header = array('icon' => 'fa-cube', "title" => "<h2>Auto PID Tune</h2>");
		$widget->body   = array('content' => $this->load->view(plugin_url('main_widget'), $data, true ), 'class'=>'no-padding', 'footer'=>$widgeFooterButtons);

		$this->addJSFile('/assets/js/plugin/flot/jquery.flot.cust.min.js'); //datatable
		$this->addJSFile('/assets/js/plugin/flot/jquery.flot.resize.min.js'); //datatable
		$this->addJSFile('/assets/js/plugin/flot/jquery.flot.fillbetween.min.js'); //datatable
		$this->addJSFile('/assets/js/plugin/flot/jquery.flot.time.min.js'); //datatable
		$this->addJSFile('/assets/js/plugin/flot/jquery.flot.tooltip.min.js'); //datatable

		//~ $this->addJSFile('/assets/js/plugin/flot/jquery.flot.orderBar.min.js');
		//~ $this->addJSFile('/assets/js/plugin/flot/jquery.flot.pie.min.js');
		//~ $this->addJSFile('/assets/js/plugin/flot/jquery.flot.navigate.min.js');

		$this->addJSFile('/assets/js/plugin/fuelux/wizard/wizard.min.old.js'); //wizard
		$this->addJsInLine($this->load->view(plugin_url('js'), $data, true));
		$this->content = $widget->print_html(true);
		$this->view();
	}

 }
 
?>
