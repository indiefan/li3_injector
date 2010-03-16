<?php

namespace li3_injector\extensions;

class Injector extends \lithium\core\Object {

	/**
	 * The current dom
	 *
	 * @var string
	 */
	public $dom = null;

	/**
	 * Auto init method, receives and stores DOM
	 *
	 * @param string $dom The current dom to run injections on
	 * @return string
	 */
	public function _init() {
		$this->dom = $this->_config['dom'];
	}

	/**
	 * Injects content into current dom in specified tag and returns new dom
	 *
	 * @param string $tag Tag in which to inject content
	 * @param string $content Content to be injected
	 * @return string
	 */
	public function inject($tag, $content) {
		$this->dom = preg_replace(
			"/(<{$tag}.*>)(.*)(<\/{$tag}>)/siU",
			"$1$2{$content}$3",
			$this->dom
		);
		return $this->dom;
	}

	/**
	 * Injects a jQuery javascript include into the head of the dom
	 *
	 * @return string
	 */
	public function jQuery() {
		return $this->inject(
			'body',
			'<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>'
		);
	}

}

?>