<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Visibility;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractScopeSniff;

class ConstVisibilitySniff extends AbstractScopeSniff
{
    function __construct()
    {
        parent::__construct([T_CLASS, T_INTERFACE], [T_CONST]);
    }

    protected function processTokenWithinScope(File $file, $stackPtr, $currScope)
    {
        $publicModifierPtr = $file->findPrevious(
            T_PUBLIC,
            $stackPtr - 1,
            null,
            false,
            null,
            true
        );

        $constantPtr = $file->findNext(
            T_STRING,
            $stackPtr + 1,
            null,
            false,
            null,
            true
        );

        if ($publicModifierPtr && $constantPtr) {
            $file->addError(
                'Public modifier should be omitted as class constants are public by default; found public modifier on class constant %s',
                $stackPtr,
                'ReduntantPublicModifier',
                [$file->getTokens()[$constantPtr]['content']]
            );
        }
    }

    protected function processTokenOutsideScope(File $file, $stackPtr)
    {
    }
}
