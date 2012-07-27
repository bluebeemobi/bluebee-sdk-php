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

require_once('SimplePhoneNumber.php');

class SimplePhoneNumberTest extends PHPUnit_Framework_TestCase
{
	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\SimplePhoneNumber(array('type' => 'sometext', 'number' => '+123456789'));
		$this->assertEquals($o->serializeForBeeApp(), '{"type":"sometext","number":"+123456789"}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\SimplePhoneNumber();
		$o->setType('sometext');
		$o->setNumber('+123456789');
		$this->assertEquals($o->serializeForBeeApp(), '{"type":"sometext","number":"+123456789"}');
	}

	public function testTruncation() {
		$o = new \bluebee\sdk\SimplePhoneNumber();
		$o->setType('0123456789X');
		$o->setNumber('+123456789');
		$this->assertEquals($o->serializeForBeeApp(), '{"type":"0123456789","number":"+123456789"}');
	}

	public function testNumberValid() {
		$o = new \bluebee\sdk\SimplePhoneNumber();
		$this->assertFalse($o->setNumber('123456789'));
		$this->assertFalse($o->setNumber('abcdefg'));
		$this->assertTrue($o->setNumber('+123456789'));
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage Type not set
	 */
	public function testMissingType() {
		$o = new \bluebee\sdk\SimplePhoneNumber();
		$o->setNumber('+123456789');
		$o->serializeForBeeApp();
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage Number not set
	 */
	public function testMissingProfileId() {
		$o = new \bluebee\sdk\SimplePhoneNumber();
		$o->setType('sometext');
		$o->serializeForBeeApp();
	}
}