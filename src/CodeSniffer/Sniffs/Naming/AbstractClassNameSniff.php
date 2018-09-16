<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class AbstractClassNameSniff implements Sniff
{
    function register()
    {
        return [
            T_CLASS,
        ];
    }

    function process(File $file, $stackPtr)
    {
        $name = $file->getDeclarationName($stackPtr);

        if ($name === null) {
            return;
        }

        if (strncasecmp('Abstract', $name, 8) !== 0) {
            return;
        }

        $props = $file->getClassProperties($stackPtr);

        if (!$props['is_abstract']) {
            return;
        }

        $pathinfo = pathinfo($file->getFilename());

        $filePathWithoutAbstractPrefix = (
            (isset($pathinfo['dirname']) ? $pathinfo['dirname'] . '/' : '')
            . mb_substr($pathinfo['basename'], 8)
        );

        if (file_exists($filePathWithoutAbstractPrefix)) {
            // file path without prefix already exists - allow this case
            return;
        }

        $file->addError(
            'Abstract class should not use the "Abstract" prefix; expected %s but found %s',
            $stackPtr,
            'AbstractPrefix',
            [mb_substr($name, 8), $name]
        );
    }
}
