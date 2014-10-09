<?php

class Jashmine
{
	public $topic;
	private $spec;
	private $specs;
	
	static private $instance;

	public function __construct($topic=NULL, $spec=NULL)
	{
		if (isset($topic))
			$this->topic = $topic;
		if (isset($spec))
			$this->spec = $spec;

		Jasmine::$instance = $this;
	}
	
	static public function instance()
	{
		return Jasmine::$instance;
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
		Jasmine::$instance = $this;
		foreach ($this->specs as $spec => $test)
		{
			$this->spec = $spec;
			$test();
		}
	}
}

function describe ($topic, $specs)
{
	$test = new Jasmine($topic, $specs);
	$specs();
	$test->run();
}

function it ($desc, $test)
{
	Jasmine::instance()->spec($desc, $test);
}

function expect ($actual)
{
	return new Expectation ($actual, Jasmine::instance());
}

class Expectation
{
	private $batch;
	private $actual;
	private $unit;

	public function __construct ($actual, $batch=NULL)
	{
		$this->batch = isset($batch)? $batch : Jasmine::instance();
		$this->actual = $actual;
		$CI = get_instance();
		$CI->load->library('unit_test');
		$this->unit = $CI->unit;
	}

	public function toEqual ($expected)
	{
		echo $this->unit->run($this->actual, $expected, $this->batch->topic());
	}

	public function toBe($archetype)
	{
		//$this->expected = $name;
		echo $this->unit->run($this->actual, "is_{$archetype}", $this->batch->topic());
	}

}
