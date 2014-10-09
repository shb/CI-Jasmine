<?php namespace CI_Jasmine;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Suite
{
	private $topic;
	private $spec;
	private $specs;

	public function __construct($topic, $spec)
	{
		$this->topic = $topic;
		$this->spec = $spec;
		// Set the current suite instance
		\Jasmine::suite($this);
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
		// Set the current suite instance
		\Jasmine::suite($this);
		// Run each defined specification inside this suite instance
		foreach ($this->specs as $spec => $test)
		{
			// Set the current specification
			$this->spec = $spec;
			// Run the expectation test for the current specification
			$test();
		}
	}
}

class Expectation
{
	private $unit;
	private $suite;
	private $actual;
	private $positivity = TRUE;

	public function __construct ($actual, $suite=NULL, $positivity=TRUE)
	{
		$CI = get_instance();
		$CI->load->library('unit_test');
		$this->unit = $CI->unit;

		$this->suite = isset($suite)? $suite : \Jasmine::suite();
		$this->actual = $actual;
		$this->positivity = $positivity;
		
		if ($positivity)
			$this->not = new \CI_Jasmine\Expectation($actual, $suite, FALSE);
	}

	public function toEqual ($expected)
	{
		echo $this->unit->run($this->actual == $expected, $this->positivity, $this->suite->topic());
	}

	public function toBe($expected)
	{
		echo $this->unit->run($this->actual === $expected, $this->positivity, $this->suite->topic());
	}

}
