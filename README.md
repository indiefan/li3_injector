###li3_injector

When writing Lithium PHP (http://lithify.me) plugins, i've come across needing to inject some markup into the page. This is a plugin that handles it. Right now it's really simple, basically you tell it which tag you want to inject your markup in, and then you tell it what to inject.

####Installation

Throw the li3_injector folder into your app/libraries directory, then add the following line to app/config/bootstrap/libraries.php

	Libraries::add('li3_injector');

That's it.

####Usage

To use the Injector class, first add the following line to the top of your php file (after namespace, before any class declarations)

	use \li3_injector\extensions\Injector

Then Injector will be available to you. Here's an example of how to inject "hello world" into the head tag of a document:

	$injector = new Injector(array("dom" => [Your_Markup_Here]));
	$newMarkup = $injector->inject("head", "hello world");

Typically i need to inject a jQuery include into a page, so i made a method to do that:

	$newMarkup = $injector->jQuery();

Finally, here is an example of how your plugin can inject a jQuery include on every single page using a filter (hurray for aop and not having to hack the core!), Do this in your plugin's config/bootstrap.php:



	use \lithium\action\Dispatcher;
	use \li3_injector\extensions\Injector;

	Dispatcher::applyFilter('_call', function($self, $params, $chain) {
		$data = $chain->next($self, $params, $chain);

		if (isset($data->body)) {
			$injector = new Injector(array("dom" => $data->body[0]));
			$data->body[0] = $injector->jQuery();
		}

		return $data;
	});

That's it. Right now it's pretty basic. May add more to it later if it's useful.