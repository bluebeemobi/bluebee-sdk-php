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

require_once('OneImage.php');

class OneImageTest extends PHPUnit_Framework_TestCase
{
	public function testGetNrOfImages() {
		$o = new \bluebee\sdk\OneImage();
		$this->assertEquals($o->getSupportedNrOfImages(), 1);
	}

	public function testEmpty() {
		$o = new \bluebee\sdk\OneImage();
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":null}');
	}

	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\OneImage(array('http://www.yoursite.com/some/validimage1.jpg'));
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg"}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\OneImage();
		$o->addImage('http://www.yoursite.com/some/validimage1.jpg');
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":"http:\/\/www.yoursite.com\/some\/validimage1.jpg"}');
	}

	public function testReset() {
		$o = new \bluebee\sdk\OneImage(array('http://www.yoursite.com/some/validimage1.jpg'));
		$o->reset();
		$this->assertEquals($o->serializeForBeeApp(), '{"firstImage":null}');
	}
}