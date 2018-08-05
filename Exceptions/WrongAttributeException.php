<?php

namespace TotalFaker\Exceptions;


class WrongAttributeException extends BaseException
{
    protected $message = "Can't find attribute or variable";
}