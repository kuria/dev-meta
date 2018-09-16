<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Visibility;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractVariableSniff;

class PropertyVisibilitySniff extends AbstractVariableSniff
{
    protected function processMemberVar(File $file, $stackPtr)
    {
        $props = $file->getMemberProperties($stackPtr);

        if ($props['scope'] === 'public' && $props['is_static'] && $props['scope_specified']) {
            $file->addError(
                'Public modifier should be omitted on public static properties; found public modifier on %s',
                $stackPtr,
                'ReduntantPublicModifier',
                [$file->getTokens()[$stackPtr]['content']]
            );
        }
    }

    protected function processVariable(File $file, $stackPtr)
    {
    }

    protected function processVariableInString(File $file, $stackPtr)
    {
    }
}
