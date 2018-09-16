<?php declare(strict_types=1);

namespace Kuria\DevMeta\CodeSniffer\File;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class StrictTypesSniff implements Sniff
{
    function register()
    {
        return [
            T_OPEN_TAG,
        ];
    }

    function process(File $file, $stackPtr)
    {
        if ($stackPtr !== 0) {
            return;
        }

        $code = $file->getTokensAsString(0, 10);

        if ($code !== "<?php declare(strict_types=1);\n\n") {
            $file->addError(
                'Strict types declaration is required directly after the PHP opening tag,'
                    . ' separated by a single space and followed by a blank line:'
                    . ' <?php declare(strict_types=1);[NEWLINE][NEWLINE]',
                $stackPtr,
                'InvalidOpenTag'
            );
        }
    }
}
