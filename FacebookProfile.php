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

namespace bluebee\sdk;

require_once('BaseTemplate.php');

class FacebookProfile extends BaseTemplate {

	protected $name;
	protected $profileId;

	/**
	 * @param array $values an associated array holding the attributes to
	 * initialize, e.g.
	 * 'name' => 'sometext',
	 * 'profileId' => 4711,
	 */
	function __construct($values = null) {
		if ((is_array($values)) && (count($values) > 0)) {
			if (array_key_exists('name', $values)) $this->setName($values['name']);
			if (array_key_exists('profileId', $values)) $this->setProfileId($values['profileId']);
		}
	}

	/**
	 * Set the name of the Facebook profile, truncated at 40 characters
	 * 
	 * @param string $name the name to set
	 * @return boolean true if the name has been set, false otherwise
	 */
	public function setName($name) {
		$this->name = substr($name, 0, 40);
		return true;
	}

	/**
	 * Set the ID of the Facebook profile
	 *
	 * @param string $profileId the profile ID to set
	 * @return boolean true if the profile ID has been set, false otherwise
	 */
	public function setProfileId($profileId) {
		if (!is_long($profileId)) return false;
		$this->profileId = $profileId;
		return true;
	}

	protected function createResultObject() {
		if (empty($this->name)) throw new \UnexpectedValueException('Name not set');
		if (empty($this->profileId)) throw new \UnexpectedValueException('Profile ID not set');

		$result = new \stdClass();
		$result->name = $this->name;
		$result->profileId = $this->profileId;

		return $result;
	}

	/**
	 * @see bluebee\sdk.BaseTemplate::serializeForBeeApp()
	 * @throws \UnexpectedValueException if a required value has not been set
	 */
	public function serializeForBeeApp() {
		return json_encode($this->createResultObject());
	}
}