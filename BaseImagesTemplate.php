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

abstract class BaseImagesTemplate extends BaseTemplate {
	protected $nrOfImages = null;
	private $names = array('firstImage', 'secondImage', 'thirdImage');
	public $images = array();

	function __construct($values = null) {
		if ((is_array($values)) && (count($values) > 0)) foreach ($values as $image) {
			$this->addImage($image);
		}
	}

	/**
	 * Gets the number of images this template supports
	 * 
	 * @return the number of images supported by this template
	 */
	public function getSupportedNrOfImages() {
		return $this->nrOfImages;
	}

	/**
	 * Add the image with the given URL to the template, truncating the URL to 255 characters
	 * 
	 * @param string $url
	 * @return true if the image was added, false if not (because all image slots have been set already)
	 */
	public function addImage($url) {
		if (count($this->images) > $this->nrOfImages) return false;
		if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) return false;
		array_push($this->images, substr($url, 0, 255));
		return true;
	}

	/**
	 * Clear all images that have been associated with this template
	 */
	public function reset() {
		$this->images = array();
	}

	/**
	 * (non-PHPdoc)
	 * @see bluebee\sdk.BaseTemplate::serializeForBeeApp()
	 */
	public function serializeForBeeApp() {
		$result = array();
		for ($i = 0; ($i < $this->nrOfImages) && ($i < count($this->images)); $i++) {
			$result[$this->names[$i]] = $this->images[$i];
		}
		for (; $i < $this->nrOfImages; $i++) {
			$result[$this->names[$i]] = null;
		}
		return json_encode($result);
	}
}