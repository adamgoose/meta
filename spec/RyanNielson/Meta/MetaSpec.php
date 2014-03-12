<?php

namespace spec\RyanNielson\Meta;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('RyanNielson\Meta\Meta');
    }

    function it_sets_attributes_correctly()
    {
        $this->set(array('title' => 'Test Title', 'description' => 'Test Description'))->shouldBe(array('title' => 'Test Title', 'description' => 'Test Description'));
        $this->set(array('author' => 'Test Author'))->shouldBe(array('title' => 'Test Title', 'description' => 'Test Description', 'author' => 'Test Author'));
        $this->set(array('title' => 'Test Title 2'))->shouldBe(array('title' => 'Test Title 2', 'description' => 'Test Description', 'author' => 'Test Author'));
    }

    function it_sets_nested_attributes_correctly()
    {
        $this->set(array('title' => 'Test Title', 'og' => array('title' => 'OG Test Title', 'url' => 'http://example.com')))->shouldBe(array('title' => 'Test Title', 'og' => array('title' => 'OG Test Title', 'url' => 'http://example.com')));
        $this->set(array('title' => 'Test Title', 'og' => array('title' => 'OG Test Title 2')))->shouldBe(array('title' => 'Test Title', 'og' => array('title' => 'OG Test Title 2', 'url' => 'http://example.com')));
    }

    function it_clears_attributes_correctly()
    {
        $this->set(array('title' => 'Test Title', 'description' => 'Test Description'));
        $this->clear()->shouldBe(array());
        $this->getAttributes()->shouldHaveCount(0);
    }

    function it_gets_attributes()
    {
        $this->set(array('title' => 'Test Title', 'description' => 'Test Description'));
        $this->getAttributes()->shouldBeArray();
        $this->getAttributes()->shouldBe(array('title' => 'Test Title', 'description' => 'Test Description'));
    }

    function it_displays_meta_tags_correctly()
    {
        $this->set(array('title' => 'Test Title', 'description' => 'Test Description', 'keywords' => array('keyword1', 'keyword2')));
        $this->display()->shouldBe("<meta name=\"title\" content=\"Test Title\"/>\n<meta name=\"description\" content=\"Test Description\"/>\n<meta name=\"keywords\" content=\"keyword1, keyword2\"/>");

        $this->set(array('title' => 'Test Title', 'description' => 'Test Description', 'keywords' => 'keyword3, keyword4'));
        $this->display()->shouldBe("<meta name=\"title\" content=\"Test Title\"/>\n<meta name=\"description\" content=\"Test Description\"/>\n<meta name=\"keywords\" content=\"keyword3, keyword4\"/>");
    }
}