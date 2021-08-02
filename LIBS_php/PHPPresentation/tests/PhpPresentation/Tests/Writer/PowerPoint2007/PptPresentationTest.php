<?php

namespace PhpPresentation\Tests\Writer\PowerPoint2007;

use PhpOffice\PhpPresentation\Tests\PhpPresentationTestCase;

class PptPresentationTest extends PhpPresentationTestCase
{
    protected $writerName = 'PowerPoint2007';

    public function testRender(): void
    {
        $this->assertZipFileExists('ppt/presentation.xml');
        $this->assertIsSchemaECMA376Valid();
    }
}
