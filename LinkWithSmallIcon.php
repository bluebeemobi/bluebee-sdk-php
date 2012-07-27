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

require_once('PlainLink.php');

class LinkWithSmallIcon extends PlainLink {

	protected $icon;

	/**
	 * @param array $values an associated array holding the attributes to
	 * initialize, e.g.
	 * 'url' => 'http://www.validurl.com',
	 * 'text' => 'sometext',
	 * 'icon' => 'http://www.yoursite.com/some/validimage.jpg',
	 */
	function __construct($values = null) {
		parent::__construct($values);
		if ((is_array($values)) && (count($values) > 0)) {
			if (array_key_exists('icon', $values)) $this->setIcon($values['icon']);
		}
	}

	/**
	 * Sets the icon of this link, truncated to 255 characters
	 * 
	 * @param string $url the URL of the icon to set
	 * @return boolean true if the icon has been set, false otherwise
	 */
	public function setIcon($url) {
		if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) return false;
		$this->icon = substr($url, 0, 255);
		return true;
	}

	protected function createResultObject() {
		$result = parent::createResultObject();
		if (empty($this->icon)) throw new \UnexpectedValueException('Icon not set');

		$result->icon = $this->icon;

		return $result;
	}
}