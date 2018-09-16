<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\Naming;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ClassNameSuffixSniff implements Sniff
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

        $token = $file->getTokens()[$stackPtr];
        $expectedSuffix = $this->getSuffix($token['code']);

        if ($expectedSuffix === null) {
            return;
        }

        if (mb_substr($name, -mb_strlen($expectedSuffix)) !== $expectedSuffix) {
            $file->addError(
                'Class, interface or trait should use the appropriate suffix; expected %s but found %s',
                $stackPtr,
                'MissingSuffix',
                [$name . $expectedSuffix, $name]
            );
        }
    }

    private function getSuffix(int $tokenCode): ?string
    {
        return [T_INTERFACE => 'Interface', T_TRAIT => 'Trait'][$tokenCode] ?? null;
    }
}
