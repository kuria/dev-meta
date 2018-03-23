<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Functions;

class ForbiddenFunctionsSniff extends \PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff
{
    public $forbiddenFunctions = [
        'array_key_exists' => 'key_exists',
        'boolval' => null,
        'chop' => 'rtrim',
        'doubleval' => null,
        'floatval' => null,
        'fputs' => 'fwrite',
        'ini_alter' => 'ini_set',
        'intval' => null,
        'is_double' => 'is_float',
        'is_integer' => 'is_int',
        'is_long' => 'is_int',
        'is_real' => 'is_float',
        'is_writable' => 'is_writeable',
        'join' => 'implode',
        'pos' => 'current',
        'sizeof' => 'count',
        'strchr' => 'strstr',
        'strval' => null,
        'user_error' => 'trigger_error',
    ];
}
