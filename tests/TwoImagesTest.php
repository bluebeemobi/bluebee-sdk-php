<?php
/*
The MIT License

Copyright (c) 2012 Dominik Sommer (dominik.sommer@bluebee.mobi)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

require_once('TwoImages.php');

class TwoImagesTest extends PHPUnit_Framework_TestCase
{
	public function testGetNrOfImages() {
		$o = new \bluebee\sdk\TwoImages();
		$this->assertEquals($o->getSupportedNrOfImages(), 2);
	}

	public function testEmpty() {
		$o = new \bluebee\sdk\TwoImages();
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":null,"secondImage":null}');
	}

	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\TwoImages(array('http://www.yoursite.com/some/validimage1.jpg'));
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg","secondImage":null}');
		$o = new \bluebee\sdk\TwoImages(array('http://www.yoursite.com/some/validimage1.jpg', 'http://www.yoursite.com/some/validimage2.jpg'));
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg","secondImage":"http:\/\/www.yoursite.com\/some\/validimage2.jpg"}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\TwoImages();
		$o->addImage('http://www.yoursite.com/some/validimage1.jpg');
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg","secondImage":null}');
		$o->addImage('http://www.yoursite.com/some/validimage2.jpg');
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg","secondImage":"http:\/\/www.yoursite.com\/some\/validimage2.jpg"}');
	}

	public function testReset() {
		$o = new \bluebee\sdk\TwoImages(array('http://www.yoursite.com/some/validimage1.jpg', 'http://www.yoursite.com/some/validimage2.jpg'));
		$o->reset();
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":null,"secondImage":null}');
	}
}