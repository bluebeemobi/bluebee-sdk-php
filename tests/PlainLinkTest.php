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

require_once('PlainLink.php');

class PlainLinkTest extends PHPUnit_Framework_TestCase
{
	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\PlainLink(array('url' => 'http://validurl.com'));
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"http:\/\/validurl.com"}');

		$o = new \bluebee\sdk\PlainLink(array('url' => 'http://validurl.com', 'text' => 'sometext'));
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"sometext"}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\PlainLink();
		$o->setUrl('http://validurl.com');
		$o->setText('sometext');
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"sometext"}');
	}

	public function testTruncation() {
		$o = new \bluebee\sdk\PlainLink();
		$o->setUrl('http://validurl.com');
		$o->setText('0123456789012345678901234567890123456789X');
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"0123456789012345678901234567890123456789"}');
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage URL not set
	 */
	public function testMissingUrl() {
		$o = new \bluebee\sdk\PlainLink();
		$o->serializeForBeeApp();
	}
}