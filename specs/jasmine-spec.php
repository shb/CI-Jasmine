<?php

describe("A suite", function() {
  it("contains spec with an expectation", function() {
    expect(true)->toBe(true);
  });
});

describe("A suite is just a function", function() {
  $a = NULL;

  it("and so is a spec", function() use ($a) {
    $a = true;

    expect($a)->toBe(true);
  });
});



describe("The 'toBe' matcher compares with ===", function() {

  it("and has a positive case", function() {
    expect(true)->toBe(true);
  });

  it("and can have a negative case", function() {
    expect(false)->not->toBe(true);
  });
});



describe("A spec", function() {
  beforeEach(function() {
    $this->foo = 0;
  });

  it("can use the `this` to share state", function() {
    expect($this->foo)->toEqual(0);
    $this->bar = "test pollution?";
  });

  it("prevents test pollution by having an empty `this` created for the next spec", function() {
    expect($this->foo)->toEqual(0);
    expect($this->bar)->toBeUndefined();
  });
});

