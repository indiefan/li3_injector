<?php

namespace li3_injector\tests\cases\extensions;

use \li3_injector\extensions\Injector;

class InjectorTest extends \lithium\test\Unit {

	public function setup() {
		$this->markup = file_get_contents(LITHIUM_APP_PATH . '/tests/mocks/extensions/simpleMarkup.html');
	}

	public function testBasicHeadInjection() {
		$expected = "/.*successful head injection<\/head>.*/s";

		$injector = new Injector(array("dom" => $this->markup));

		$result = $injector->inject("head", "successful head injection");

		$this->assertPattern($expected, $result);
	}

	public function testBasicBodyInjection() {
		$expected = "/.*successful body injection<\/body>.*/s";

		$injector = new Injector(array("dom" => $this->markup));

		$result = $injector->inject("body", "successful body injection");

		$this->assertPattern($expected, $result);
	}

	public function testInjectionWithUnsafeCharacters() {
		$expected = "/.*\(\)\/.*/s";

		$injector = new Injector(array("dom" => $this->markup));

		$result = $injector->inject("head", "()/");

		$this->assertPattern($expected, $result);
	}
	
	public function testGoogleAnalyticsInjection() {
	  $expected = '/.*<script type="text\/javascript">.+_gaq.push\(\["_setAccount", "UA-123456-7"]\);.*/s';
	  
	  $injector = new Injector(array("dom" => $this->markup));
	  
	  $result = $injector->googleAnalytics('UA-123456-7');
	  
	  $this->assertPattern($expected, $result);
	}

	public function testJQueryInjection() {
		$expected = "/.*<script type=\"text\/javascript\" src=\"http:\/\/ajax.googleapis.com\/ajax\/libs\/jquery\/1.4.2\/jquery.min.js\"><\/script>.*/s";

		$injector = new Injector(array("dom" => $this->markup));

		$result = $injector->jQuery();

		$this->assertPattern($expected, $result);
	}
}
?>