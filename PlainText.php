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

class PlainText extends BaseTemplate {

	protected $text;

	/**
	 * @param array $values an associated array holding the attributes to
	 * initialize, e.g.
	 * 'text' => 'sometext',
	 */
	function __construct($values = null) {
		if ((is_array($values)) && (count($values) > 0)) {
			if (array_key_exists('text', $values)) $this->setText($values['text']);
		}
	}

	/**
	 * Set the text, truncated at 800 characters
	 * 
	 * @param string $text the text to set
	 * @return boolean true if the text has been set, false otherwise
	 */
	public function setText($text) {
		$this->text = substr($text, 0, 800);
		return true;
	}

	protected function createResultObject() {
		if (empty($this->text)) throw new \UnexpectedValueException('Text not set');
		
		$result = new \stdClass();
		$result->text = $this->text;

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