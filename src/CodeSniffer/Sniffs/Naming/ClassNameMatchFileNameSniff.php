<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Util\Common;

/**
 * Suplemental strict camel caps sniff
 */
class ClassNameMatchFileNameSniff implements Sniff
{
    function register()
    {
        return [
            T_CLASS,
            T_INTERFACE,
            T_TRAIT,
        ];
    }

    function process(File $file, $stackPtr)
    {
        $name = $file->getDeclarationName($stackPtr);

        if ($name === null) {
            return;
        }

        $nextClassPtr = $file->findNext($this->register(), $stackPtr + 1);

        if (is_int($nextClassPtr) && $file->getDeclarationName($nextClassPtr) !== null) {
            // multiple classes in a file
            return $file->numTokens + 1;
        }

        $pathinfo = pathinfo($file->getFilename());
        $fileNameSuffix = isset($pathinfo['extension']) ? ".{$pathinfo['extension']}" : '';

        if ($pathinfo['filename'] !== $name) {
            $file->addError(
                'File name does not match class, interface or trait name; expected %s but found %s',
                $stackPtr,
                'Mismatch',
                [$name . $fileNameSuffix, $pathinfo['filename'] . $fileNameSuffix]
            );
        }
    }
}
