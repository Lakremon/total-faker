<?php

namespace TotalFaker\Exceptions;


class RandomFunctionException extends BaseException
{
    protected $message = 'There are not cryptographically secure random function.';
}