<?php
/**
 * Created by PhpStorm.
 * User: lakremon
 * Date: 8/5/18
 * Time: 7:42 PM
 */

namespace TotalFaker\Exceptions;


class WrongRandomizerPullLength extends BaseException
{

    protected $message = "Your pull for random string can't be empty string";

}