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
	 * Injects a Google Analytics include into the head of the dom
	 *
	 * @param string $account Account ID
	 * @return string
	 */
	public function googleAnalytics($account) {
	  return $this->inject(
	    'body',
	    '<script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(["_setAccount", "'.$account.'"]);
        _gaq.push(["_trackPageview"]);

        (function() {
          var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
          ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
          var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
        })();

      </script>'
	  );
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