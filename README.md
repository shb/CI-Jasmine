CodeIgniter Jasmine
===================

**Simple Jasmine-like CodeIgniter unit testing wrapper library**


Installation
------------

Copy the `application/libraries/Jasmine.php` file inside your CodeIgniter
application's libraries directory.

Usage
-----

Load the library with (usually you'll want to do this inside a controller):

    $this->load->library('jasmine')

After doing this you can run test like this:

    describe("CI-Jasmine", function()
    {

      it("can test against literal values", function () {
        $value = 'right';
		  expect($value)->toEqual('right');
      });
      
      it("can test by type", function () {
        $string = 'imastring';
        expect($string)->toBe('string');
      });
      
      // And so on...

    });


`epect($actual)->toEqual($value)` tests the _actual_ against an immediate _value_.

When using `expect($actual)->toBe($type)`, _$type_ can refer to any of the CodeIgniter standard `is_*` tests.
