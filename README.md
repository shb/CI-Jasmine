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
        $left = 'right';
        expect($left)->toBe('right');
      });

      // And so on...

    });


Roadmap
-------

### v 1.0.0

- Make PHP-Jasmine framework independent
- Include framework wrappers as library addons in a single repository or
- Make different repositories with wrappers for different frameworks?
