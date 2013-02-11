<?php

namespace Rouffj\Slugify\Tests;

use Rouffj\Slugify\Infra\SlugGenerator\AsciiGenerator;
use Rouffj\Slugify\Infra\SlugGenerator\PassthruGenerator;

class AcceptanceTest extends \PhpUnit_Framework_TestCase
{
    public function testEntitySlugificationWithPassthruSlugifier()
    {
        $title = 'Hello slugifier!';
        $entity = new BasicEntity($title);
        $entity->slugify(new PassthruGenerator());
        $this->assertEquals($title, $entity->getSlug());
    }

    /** @dataProvider getEntityAsciiTextPropertySlugificationTestData */
    public function testEntityAsciiTextPropertySlugification($title, $slug)
    {
        $entity = new BasicEntity($title);
        $entity->slugify(new AsciiGenerator());
        $this->assertEquals($slug, $entity->getSlug());
    }

    public function getEntityAsciiTextPropertySlugificationTestData()
    {
        return array(
            array('    ',             ''),
            array('&&&é---',          ''),
            array('hello world !!',   'hello-world'),
            array('hello      world', 'hello-world'),
            array('AbC',              'abc'),
            array('é&tè!hello_(_',    't-hello'),
        );
    }
}
