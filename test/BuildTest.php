<?php

namespace Test;

use Apprentice\Build;

class BuildTest extends BaseTestCase
{
    public function setUp()
    {
        load_config(__DIR__ . '/static/config.php');
    }

    public function tearDown()
    {
        $files = glob('/tmp/apprentice_output/*');
        foreach ($files as $file) {
            unlink($file);
        }

        rmdir('/tmp/apprentice_output');
    }

    public function test_build_single_page()
    {
        $build = new Build();

        $build->runSingleBuild('test');

        $html = file_get_contents('/tmp/apprentice_output/test.html');
        $expectedHtml = "<div>Test Title</div>\n" .
            "<div>Test Subtitle</div>\n" .
            "<div>Test Description</div>\n" .
            "<div>&lt;p&gt;Test comment&lt;/p&gt;\n" .
            "&lt;pre&gt;&lt;code class=&quot;language-php&quot;&gt;\$test = &#039;test&#039;;&lt;/code&gt;&lt;/pre&gt;</div>\n";

        $this->assertFalse(empty($html));
        $this->assertEquals($expectedHtml, $html);
    }

    public function test_build_all()
    {
        $build = new Build();

        $build->buildAll();

        $expectedHtml = "<div>Test Title</div>\n" .
            "<div>Test Subtitle</div>\n" .
            "<div>Test Description</div>\n" .
            "<div>&lt;p&gt;Test comment&lt;/p&gt;\n" .
            "&lt;pre&gt;&lt;code class=&quot;language-php&quot;&gt;\$test = &#039;test&#039;;&lt;/code&gt;&lt;/pre&gt;</div>\n";
        $expectedHtml2 = "<div>index</div>\n";

        $html = file_get_contents('/tmp/apprentice_output/test.html');
        $html2 = file_get_contents('/tmp/apprentice_output/index.html');

        $this->assertEquals($expectedHtml, $html);
        $this->assertEquals($expectedHtml2, $html2);
        $this->assertTrue(file_exists('/tmp/apprentice_output/test.txt'));
        $this->assertTrue(file_exists('/tmp/apprentice_output/TEST'));
    }
}
