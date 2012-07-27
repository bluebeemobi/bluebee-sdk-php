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

class SimplePhoneNumber extends BaseTemplate {

	protected $type;
	protected $number;

	/**
	 * @param array $values an associated array holding the attributes to
	 * initialize, e.g.
	 * 'type' => 'sometext',
	 * 'number' => '+123456789',
	 */
	function __construct($values = null) {
		if ((is_array($values)) && (count($values) > 0)) {
			if (array_key_exists('type', $values)) $this->setType($values['type']);
			if (array_key_exists('number', $values)) $this->setNumber($values['number']);
		}
	}

	/**
	 * Set the type of the phone number, truncated at 10 characters
	 * 
	 * @param string $type the type to set
	 * @return boolean true if the name has been set, false otherwise
	 */
	public function setType($type) {
		$this->type = substr($type, 0, 10);
		return true;
	}

	/**
	 * Set the phone number in this format:
	 * +12345678901234567
	 *
	 * @param string $number the phone number to set
	 * @return boolean true if the phone number has been set, false otherwise
	 */
	public function setNumber($number) {
		if (!preg_match('/\+[0-9]{3,16}$/', $number)) return false;
		$this->number = $number;
		return true;
	}

	protected function createResultObject() {
		if (empty($this->type)) throw new \UnexpectedValueException('Type not set');
		if (empty($this->number)) throw new \UnexpectedValueException('Number not set');

		$result = new \stdClass();
		$result->type = $this->type;
		$result->number = $this->number;

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