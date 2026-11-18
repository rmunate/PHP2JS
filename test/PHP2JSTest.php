<?php

use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;
use Rmunate\Php2Js\Macros\Php2JsServiceProvider;

class PHP2JSTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [Php2JsServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app['view']->addLocation(__DIR__.'/fixtures');
        $this->withoutDeprecationHandling();
    }

    public function testToJsSharesViewData(): void
    {
        $data = ['message' => 'A & "B" <C>', 'enabled' => false, 'count' => 0];
        $response = view('page', $data)->toJS();

        $this->assertSharedData($response, 'PHP2JS', $data);
        self::assertStringContainsString('<p>A &amp; &quot;B&quot; &lt;C&gt;</p>', $response->getContent());
    }

    public function testToStrictJsSharesOnlyExplicitDataWithACustomAlias(): void
    {
        $data = ['count' => 0];
        $response = view('page', ['message' => 'Blade only'])->toStrictJS($data, 'ClientData');

        $this->assertSharedData($response, 'ClientData', $data);
        self::assertStringContainsString('<p>Blade only</p>', $response->getContent());
    }

    private function assertSharedData(Response $response, string $alias, array $expected): void
    {
        self::assertSame(200, $response->getStatusCode());

        $name = preg_quote("X-{$alias}-DATA", '~');
        $pattern = '~<meta name="'.$name.'" content="([^"]*)">\s*<script>(.*?)</script>\s*</head>~s';
        self::assertSame(1, preg_match($pattern, $response->getContent(), $matches));
        self::assertStringContainsString('meta[name="X-'.$alias.'-DATA"]', $matches[2]);
        self::assertSame(
            $expected,
            json_decode(html_entity_decode($matches[1], ENT_QUOTES, 'UTF-8'), true, flags: JSON_THROW_ON_ERROR)
        );
    }
}
