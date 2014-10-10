<?php namespace CI_Jasmine;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suite
{
	private $topic;
	private $specs;
	private $spec;
	private $setup;

	public function __construct($topic, $spec)
	{
		$this->topic = $topic;
		$this->spec = $spec;
		// Set the current suite instance
		\Jasmine::suite($this);
	}

	public function setup($func)
	{
		$this->setup = $func;
	}

	public function spec ($desc, $test)
	{
		$this->specs[$this->topic.' '.$desc] = $test;
	}

	public function topic ()
	{
		return empty($this->spec)? $this->topic : $this->spec;
	}

	public function run()
	{
		$app = get_instance();
		$app->load->library('unit_test');

		// Set the current suite instance
		\Jasmine::suite($this);
		// Run each defined specification inside this suite instance
		foreach ($this->specs as $spec => $test)
		{
			// Set the current specification
			$this->spec = $spec;
			$ctx = new \stdClass;
			try
			{
				// Possibly run setup handler
				if (isset($this->setup)) {
					$setup = $this->setup->bindTo($ctx);
					$setup();
				}
				// Try to run the expectation test for the current specification
				$boundTest = $test->bindTo($ctx);
				try {
					$boundTest();
					echo $app->unit->run(TRUE,TRUE, $this->topic());
				} catch (Failure $fail) {
					// Print failure message and continue to next test
					echo $app->unit->run(FALSE,TRUE, $this->topic(), "Test failed: ".$fail->getMessage());
					continue;
				}
				//TODO: posisbily run teardown handler
			}
			catch (\Exception $ex)
			{
				// Print exception and halt testing
				echo $app->unit->run(FALSE,TRUE, $this->topic(), "Exception thrown: ".$ex->getMessage());
				break;
			}
		}
	}
}

class Expectation
{
	//private $unit;
	private $suite;
	private $actual;
	private $positivity = TRUE;
	private $be = 'is not';

	public function __construct ($actual, $suite=NULL, $positivity=TRUE)
	{
		/*$CI = get_instance();
		$CI->load->library('unit_test');
		$this->unit = $CI->unit;*/

		$this->suite = isset($suite)? $suite : \Jasmine::suite();
		$this->actual = $actual;
		$this->positivity = $positivity;
		
		if ($positivity) {
			$this->be = 'is not';
			$this->not = new \CI_Jasmine\Expectation($actual, $suite, FALSE);
		} else {
			$this->be = 'is indeed';
		}
	}
	
	private function fail ($verb, $expected='')
	{
		$msg = trim("{$this->actual} {$this->be} {$verb} {$expected}");
		throw new Failure($msg);
	}

	public function toEqual ($expected)
	{
		if (($this->actual == $expected) === $this->positivity) return TRUE;
		else $this->fail('equal to', $expected);
	}

	public function toBe($expected)
	{
		if (($this->actual === $expected) === $this->positivity) return TRUE;
		else $this->fail('the same as', $expected);
	}
	
	public function toBeDefined()
	{
		if (isset($this->actual) === $this->positivity) return TRUE;
		else $this->fail('defined');
	}
	
	public function toBeUndefined()
	{
		if (!isset($this->actual) === $this->positivity) return TRUE;
		else $this->fail('undefined');
	}

}

class Failure extends \Exception
{
}
