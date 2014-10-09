<?php

class Specs extends CI_Controller
{
	public function run ($layer, $class=NULL)
	{
		$this->load->library('jasmine');
		echo '<!DOCTYPE html><html><head><meta charset="utf-8"/><title>Test run - '.$layer.'</title></head><body>';
		if ($class)
			include dirname(BASEPATH)."/specs/{$layer}/{$class}-spec.php";
		else
			include dirname(BASEPATH)."/specs/{$layer}-spec.php";
		echo '</body></html>';
	}
}
