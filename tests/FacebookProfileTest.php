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

require_once('FacebookProfile.php');

class FacebookProfileTest extends PHPUnit_Framework_TestCase
{
	public function testInitViaConstructor() {
		$o = new \bluebee\sdk\FacebookProfile(array('name' => 'sometext', 'profileId' => 4711));
		$this->assertEquals($o->serializeForBeeApp(), '{"name":"sometext","profileId":4711}');
	}

	public function testInitViaSetters() {
		$o = new \bluebee\sdk\FacebookProfile();
		$o->setName('sometext');
		$o->setProfileId(4711);
		$this->assertEquals($o->serializeForBeeApp(), '{"name":"sometext","profileId":4711}');
	}

	public function testTruncation() {
		$o = new \bluebee\sdk\FacebookProfile();
		$o->setName('0123456789012345678901234567890123456789X');
		$o->setProfileId(4711);
		$this->assertEquals($o->serializeForBeeApp(), '{"name":"0123456789012345678901234567890123456789","profileId":4711}');
	}

	public function testNumericProfileId() {
		$o = new \bluebee\sdk\FacebookProfile();
		$this->assertFalse($o->setProfileId('4711'));
		$this->assertTrue($o->setProfileId(4711));
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage Name not set
	 */
	public function testMissingName() {
		$o = new \bluebee\sdk\FacebookProfile();
		$o->setProfileId(4711);
		$o->serializeForBeeApp();
	}

	/**
	 * @expectedException UnexpectedValueException
	 * @expectedExceptionMessage Profile ID not set
	 */
	public function testMissingProfileId() {
		$o = new \bluebee\sdk\FacebookProfile();
		$o->setName('sometext');
		$o->serializeForBeeApp();
	}
}