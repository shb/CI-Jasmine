CodeIgniter Jasmine
===================

**Simple Jasmine-like CodeIgniter unit test wrapper library*


Installation
------------

Copy the `application/libraries/Jasmine.php` inside your 
CodeIgn
iter application's libraries directory.

Description
-----------

This library wraps the simple CodeIgnter unit testing library in a 
Jasmine-like interface. With this you can write tests like:

    $this->load->library('jasmine');
    describe("CI-Jasmine", function()
    {

      it("can test immediate values", function () {
        $value = 'right';
		  expect($value)->toEqual('right');
      });
      
      it("can test by type", function () {
        $string = 'imastring';
        expect($string)->toBe('string');
      });
      
      // And so on...

    });

When using `expect($actual)->toBe($type)` _$type_ can be any of the 
CodeIgniter standard `is_*` tests.
