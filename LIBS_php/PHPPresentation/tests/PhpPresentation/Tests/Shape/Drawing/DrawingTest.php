<?php
/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @copyright   2009-2015 PHPPresentation contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 */

namespace PhpOffice\PhpPresentation\Shape\Drawing;

use PhpOffice\PhpPresentation\Tests\Shape\Drawing\DrawingTest;

function function_exists(string $function): bool
{
    if ('getimagesizefromstring' === $function) {
        return DrawingTest::$getimagesizefromstringExists;
    }

    return \function_exists($function);
}

namespace PhpOffice\PhpPresentation\Tests\Shape\Drawing;

// @codingStandardsIgnoreStart
use PHPUnit\Framework\TestCase;

// @codingStandardsIgnoreEnd
class DrawingTest extends TestCase
{
    /**
     * @var bool
     */
    public static $getimagesizefromstringExists = true;

    public function testIgnore(): void
    {
    }
}
