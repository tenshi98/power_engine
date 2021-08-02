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

namespace PhpOffice\PhpPresentation\Tests\Shape\Chart;

use PhpOffice\PhpPresentation\Shape\Chart\View3D;
use PHPUnit\Framework\TestCase;

/**
 * Test class for View3D element.
 *
 * @coversDefaultClass \PhpOffice\PhpPresentation\Shape\Chart\View3D
 */
class View3DTest extends TestCase
{
    public function testDepthPercent(): void
    {
        $object = new View3D();
        $value = mt_rand(20, 20000);

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setDepthPercent());
        $this->assertEquals(100, $object->getDepthPercent());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setDepthPercent($value));
        $this->assertEquals($value, $object->getDepthPercent());
    }

    public function testHashIndex(): void
    {
        $object = new View3D();
        $value = mt_rand(1, 100);

        $this->assertEmpty($object->getHashIndex());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setHashIndex($value));
        $this->assertEquals($value, $object->getHashIndex());
    }

    public function testHeightPercent(): void
    {
        $object = new View3D();
        $value = mt_rand(5, 500);

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setHeightPercent());
        $this->assertEquals(100, $object->getHeightPercent());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setHeightPercent($value));
        $this->assertEquals($value, $object->getHeightPercent());
    }

    public function testPerspective(): void
    {
        $object = new View3D();
        $value = mt_rand(0, 100);

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setPerspective());
        $this->assertEquals(30, $object->getPerspective());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setPerspective($value));
        $this->assertEquals($value, $object->getPerspective());
    }

    public function testRightAngleAxes(): void
    {
        $object = new View3D();

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRightAngleAxes());
        $this->assertTrue($object->hasRightAngleAxes());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRightAngleAxes(true));
        $this->assertTrue($object->hasRightAngleAxes());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRightAngleAxes(false));
        $this->assertFalse($object->hasRightAngleAxes());
    }

    public function testRotationX(): void
    {
        $object = new View3D();
        $value = mt_rand(-90, 90);

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRotationX());
        $this->assertEquals(0, $object->getRotationX());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRotationX($value));
        $this->assertEquals($value, $object->getRotationX());
    }

    public function testRotationY(): void
    {
        $object = new View3D();
        $value = mt_rand(-90, 90);

        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRotationY());
        $this->assertEquals(0, $object->getRotationY());
        $this->assertInstanceOf('PhpOffice\\PhpPresentation\\Shape\\Chart\\View3D', $object->setRotationY($value));
        $this->assertEquals($value, $object->getRotationY());
    }
}
