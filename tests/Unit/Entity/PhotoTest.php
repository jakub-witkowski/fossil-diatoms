<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Photo;

class PhotoTest extends TestCase
{
    public function testSetterAndGetterFunctions(): void
    {
        $photo = new Photo();
        $isPublished = true;
        $filename = "This is a test filename";
        $description = "This is a test description.";
        $timesViewed = 300;
        
        $photo->setPublished($isPublished);
        $photo->setFilename($filename);
        $photo->setDescription($description);
        $photo->setTimesViewed($timesViewed);

        self::assertEquals($photo->isPublished(), 1);
        self::assertSame($photo->getFilename(), $filename);
        self::assertSame($photo->getDescription(), $description);
        self::assertEquals($photo->getTimesViewed(), $timesViewed);
    }
}