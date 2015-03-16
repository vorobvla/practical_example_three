<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Exception;

use Exception;

class ItemAlreadyExistsException extends \Exception {

	public function __construct($message = "Item already exists.", $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}