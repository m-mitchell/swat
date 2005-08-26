<?php

require_once 'Swat/SwatApplication.php';
require_once 'pages/DemoPage.php';

/**
 * An demo application
 *
 * This is an application to demonstrate various Swat widgets.
 *
 * @package   SwatDemo
 * @copyright 2005 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class DemoApplication extends SwatApplication
{
	protected function resolvePage()
	{
		$demo = SwatApplication::initVar('demo', 'FrontPage',
			SwatApplication::VAR_GET);

		// simple security
		$demo = basename($demo);

		if (file_exists('../include/pages/'.$demo.'.php')) {
			require_once '../include/pages/'.$demo.'.php';
			return new $demo($this);
		} else {
			return new DemoPage($this);
		}
	}
}

?>
