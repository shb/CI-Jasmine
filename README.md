CodeIgniter Jasmine
===================

**Jasmine-compatible unit testing wrapper library for CodeIgniter 2.x**


Installation
------------

Copy the files `Jasmine.php` and `CI_Jasmin.php` from `application/libraries/` into your CodeIgniter
application's libraries directory.

Usage
-----

Load the library with:

    $this->load->library('jasmine')

 (usually you want to do this inside a controller). Then you can run tests like this:

    describe("CI-Jasmine", function()
    {

      it("can test against literal values", function () {
        $left = 'right';
        expect($left)->toBe('right');
      });

      // And so on...

    });


Roadmap
-------

### v 1.0.0

- Make PHP-Jasmine framework independent
- Include framework wrappers as library addons in a single repository _or_
- Make different repositories with wrappers for different frameworks?


Wrappers
--------

By making the library ouput function customizable one can write wrappers to
seamlessly run PHPJasmine inside any web application framework.

Wrapper should bew written for the most popular application 
frameworks that only have basic testing support.

The wrappers might adapt the API to resemble or match the test 
function already found inside the frameworks.
