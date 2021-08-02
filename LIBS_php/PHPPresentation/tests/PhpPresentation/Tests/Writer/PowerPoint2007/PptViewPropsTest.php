<?php

namespace PhpPresentation\Tests\Writer\PowerPoint2007;

use PhpOffice\PhpPresentation\PresentationProperties;
use PhpOffice\PhpPresentation\Tests\PhpPresentationTestCase;

class PptViewPropsTest extends PhpPresentationTestCase
{
    protected $writerName = 'PowerPoint2007';

    public function testRender(): void
    {
        $expectedElement = '/p:viewPr';

        $this->assertZipFileExists('ppt/viewProps.xml');
        $this->assertZipXmlElementExists('ppt/viewProps.xml', $expectedElement);
        $this->assertZipXmlAttributeEquals('ppt/viewProps.xml', $expectedElement, 'showComments', 0);
        $this->assertZipXmlAttributeEquals('ppt/viewProps.xml', $expectedElement, 'lastView', PresentationProperties::VIEW_SLIDE);
        $this->assertIsSchemaECMA376Valid();
    }

    public function testCommentVisible(): void
    {
        $expectedElement = '/p:viewPr';

        $this->oPresentation->getPresentationProperties()->setCommentVisible(true);

        $this->assertZipFileExists('ppt/viewProps.xml');
        $this->assertZipXmlElementExists('ppt/viewProps.xml', $expectedElement);
        $this->assertZipXmlAttributeEquals('ppt/viewProps.xml', $expectedElement, 'showComments', 1);
        $this->assertIsSchemaECMA376Valid();
    }

    public function testLastView(): void
    {
        $expectedElement = '/p:viewPr';
        $expectedLastView = PresentationProperties::VIEW_OUTLINE;

        $this->oPresentation->getPresentationProperties()->setLastView($expectedLastView);

        $this->assertZipFileExists('ppt/viewProps.xml');
        $this->assertZipXmlElementExists('ppt/viewProps.xml', $expectedElement);
        $this->assertZipXmlAttributeEquals('ppt/viewProps.xml', $expectedElement, 'lastView', $expectedLastView);
        $this->assertIsSchemaECMA376Valid();
    }
}
