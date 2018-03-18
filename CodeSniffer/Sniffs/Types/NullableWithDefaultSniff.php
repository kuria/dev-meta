<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Types;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class NullableWithDefaultSniff implements Sniff
{
    function register()
    {
        return [
            T_FUNCTION,
        ];
    }

    function process(File $file, $stackPtr)
    {
        foreach ($file->getMethodParameters($stackPtr) as $param) {
            if (
                !empty($param['type_hint'])
                && isset($param['default'])
                && strcasecmp($param['default'], 'null') === 0
                && !$param['nullable_type']
            ) {
                $file->addError(
                    'Type-hinted parameters with null default value should also be declared as nullable; expected ?%s %s but found %1$s %2$s',
                    $param['token'],
                    'MissingNullable',
                    [$param['type_hint'], $param['name']]
                );
            }
        }
    }
}
