<?php

namespace TotalFaker\Exceptions;


class WrongRandomStringLengthException extends BaseException
{
    protected $message = "Your string length can't be less then zero.";
}