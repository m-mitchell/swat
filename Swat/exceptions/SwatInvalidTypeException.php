<?php

/* vim: set noexpandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

require_once 'Swat/exceptions/SwatException.php';

/**
 * Thrown when a value is of the wrong type
 *
 * @package   Swat
 * @copyright 2007-2016 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class SwatInvalidTypeException extends SwatException
{
	// {{{ protected properties

	/**
	 * The value that is of the wrong type
	 *
	 * @var mixed
	 */
	protected $value = null;

	// }}}
	// {{{ public function __construct()

	/**
	 * Creates a new invalid type exception
	 *
	 * @param string $message the message of the exception.
	 * @param integer $code the code of the exception.
	 * @param mixed $value the value that is of the wrong type.
	 */
	public function __construct($message = null, $code = 0, $value = null)
	{
		parent::__construct($message, $code);
		$this->value = $value;
	}

	// }}}
	// {{{ public function getValue()

	/**
	 * Gets the value that is of the wrong type
	 *
	 * @return mixed the value that is of the wrong type.
	 */
	public function getValue()
	{
		return $this->value;
	}

	// }}}
}

?>
