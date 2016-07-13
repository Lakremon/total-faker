<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 13.07.2016
 * Time: 12:27
 */

namespace totalFaker\Exceptions;


class WrongAttributeException extends BaseException
{
    protected $message = "Can't find attribute or variable";

}