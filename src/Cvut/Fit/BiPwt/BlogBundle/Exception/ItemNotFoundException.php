<?php
namespace Cvut\Fit\BiPwt\BlogBundle\Exception;

use Exception;

class ItemNotFoundException extends \Exception {

	public function __construct($message = "Item not found.", $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}