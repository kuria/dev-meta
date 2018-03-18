<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Visibility;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class MethodVisibilitySniff implements Sniff
{
    function register()
    {
        return [
            T_FUNCTION,
        ];
    }

    function process(File $file, $stackPtr)
    {
        $name = $file->getDeclarationName($stackPtr);

        if ($name === null) {
            return;
        }

        $props = $file->getMethodProperties($stackPtr);

        if ($props['scope'] === 'public' && $props['scope_specified']) {
            $file->addError(
                'Public modifier should be omitted as methods are public by default; found public modifier on method %s',
                $stackPtr,
                'ReduntantPublicModifier',
                [$name]
            );
        }
    }
}
