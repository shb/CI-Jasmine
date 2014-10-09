<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jasmine
{
	static private $instance;

	/* Get or set curretn Jasmin Suite */
	static public function suite($instance=NULL)
	{
		if (isset($instance)) {
			\Jasmine::$instance = $instance;
			if (isset($this))
				return $this;
		} else {
			return \Jasmine::$instance;
		}
	}

	/* Proxy current Jasmin Suite methods */

	public function spec ($desc, $test)
	{
		$this->instance->spec($desc, $test);
	}

	public function topic ()
	{
		return $this->instance->topic();
	}

	public function run()
	{
		$this->instance->run();
	}
}

require_once (dirname(__FILE__).DIRECTORY_SEPARATOR.'CI_Jasmine.php');

function describe ($topic, $specs)
{
	// Create a new suite
	$suite = new \CI_Jasmine\Suite($topic, $specs);
	// Run the user defined suite specification
	$specs();
	// Evaluate the test suite
	$suite->run();
}

function beforeEach($func)
{
	\Jasmine::suite()->setup($func);
}

function it ($desc, $test)
{
	\Jasmine::suite()->spec($desc, $test);
}

function expect ($actual)
{
	return new \CI_Jasmine\Expectation ($actual, \Jasmine::suite());
}
