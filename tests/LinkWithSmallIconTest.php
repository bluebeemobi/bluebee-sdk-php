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

require_once('LinkWithSmallIcon.php');

class LinkWithSmallIconTest extends PHPUnit_Framework_TestCase
{
	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\LinkWithSmallIcon(array('url' => 'http://validurl.com', 'text' => 'sometext', 'icon' => 'http://www.yoursite.com/some/validimage.jpg'));
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"sometext","icon":"http:\/\/www.yoursite.com\/some\/validimage.jpg"}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\LinkWithSmallIcon();
		$o->setUrl('http://validurl.com');
		$o->setText('sometext');
		$o->setIcon('http://www.yoursite.com/some/validimage.jpg');
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"sometext","icon":"http:\/\/www.yoursite.com\/some\/validimage.jpg"}');
	}

	public function testTruncation() {
		$o = new \bluebee\sdk\LinkWithSmallIcon();
		$o->setUrl('http://validurl.com');
		$o->setText('0123456789012345678901234567890123456789X');
		$o->setIcon('http://www.yoursite.com/some/validimage.jpg');
		$this->assertEquals($o->serializeForBeeApp(), '{"url":"http:\/\/validurl.com","text":"0123456789012345678901234567890123456789","icon":"http:\/\/www.yoursite.com\/some\/validimage.jpg"}');
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage Icon not set
	 */
	public function testMissingIcon() {
		$o = new \bluebee\sdk\LinkWithSmallIcon(array('url' => 'http://validurl.com'));
		$o->serializeForBeeApp();
	}
}