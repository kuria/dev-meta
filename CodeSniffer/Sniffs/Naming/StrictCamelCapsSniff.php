<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Common;

/**
 * Suplemental strict camel caps sniff
 */
class StrictCamelCapsSniff implements Sniff
{
    function register()
    {
        return [
            T_CLASS,
            T_INTERFACE,
            T_TRAIT,
            T_FUNCTION,
        ];
    }

    function process(File $file, $stackPtr)
    {
        $name = $file->getDeclarationName($stackPtr);

        if ($name === null) {
            return;
        }

        $tokens = $file->getTokens();

        $isFunctionName = $tokens[$stackPtr]['code'] === T_FUNCTION;

        if (!Common::isCamelCaps($name, !$isFunctionName, true, false)) {
            // handled by other sniffs
            return;
        }

        if (!Common::isCamelCaps($name, !$isFunctionName, true, true)) {
            $file->addError(
                'Class and function names should use camel caps without consecutive uppercase; expected %s but found %s',
                $stackPtr,
                'StrictCamelCaps',
                [$this->getCorrectName($name), $name]
            );
        }
    }

    private function getCorrectName(string $badName): string
    {
        return preg_replace_callback(
            '{([A-Z]+)([A-Z]|$)}',
            function (array $match) {
                return sprintf(
                    '%s%s%s',
                    mb_substr($match[1], 0, 1),
                    mb_strtolower(mb_substr($match[1], 1)),
                    $match[2]
                );
            },
            $badName
        );
    }
}
