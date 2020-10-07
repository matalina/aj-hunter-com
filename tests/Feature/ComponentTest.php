<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\View\Components\Blog;

class ComponentTest extends TestCase
{
    protected $feed;
    public function __construct()
    {
        parent::__construct();

        $date1 = now()->toDateTimeString();
        $date2 = now()->subDay()->ToDateTimeString();
        $date3 = now()->subDays(2)->ToDateTimeString();

        $this->feed = [
            ['title' => 'Blog 1', 'body' => 'This is test data', 'date' => $date1],
            ['title' => 'Blog 2', 'body' => 'This is test data 2', 'date' => $date2],
            ['title' => 'Blog 3', 'body' => 'This is test data 3', 'date' => $date3],
        ];
    }

     /**
     * @test
     */
    public function logo_component_exists()
    {
        $view = $this->blade(
            '<x-logo />'
        );

        $view->assertSee('<img src=', false);
        $view->assertSee('id="logo"', false);
    }

    /**
     * @test
     */
    public function menu_component_exists()
    {
        $view = $this->blade(
            '<x-menu :active="$active" />',[
                'active' => 'home'
            ]
        );

        $view->assertSee('Home');
        $view->assertSee('Contact');
        $view->assertSee('The Mind of Nox');
        $view->assertSee('Books');
        $view->assertSee('About');
        $view->assertSee('id="menu"', false);
    }

    /**
     * @test
     */
    public function social_icons_component_exists()
    {
        $view = $this->blade(
            '<x-social />'
        );

        $view->assertSee('Twitter');
        $view->assertSee('Facebook');
        $view->assertSee('WordPress');
        $view->assertSee('id="social"', false);
    }

    /**
     * @test
     */
    public function hero_image_component_exists()
    {
        $view = $this->blade(
            '<x-hero />'
        );

        $view->assertSee('<img src=', false);
        $view->assertSee('id="hero"', false);
    }

    /**
     * @test
     */

    public function layout_component_exists()
    {
        $view = $this->blade(
            '<x-layout><h1>Test</h1></x-layout>'
        );

        $view->assertSee('<h1>Test</h1>', false);
    }

    /**
     * @test
     */
    public function layout_component_has_common_components()
    {
        $view = $this->blade(
            '<x-layout><h1>Test</h1></x-layout>'
        );

        $view->assertSee('id="hero"', false);
        $view->assertSee('id="menu"', false);
        $view->assertSee('id="logo"', false);
        $view->assertSee('id="social"', false);
    }

    /**
     * @test
     */
    public function newsletter_componenet_exists()
    {
        $view = $this->blade(
            '<x-newsletter />'
        );

        $view->assertSee('id="newsletter"', false);
    }

    /**
     * @test
     */
    public function wip_componenet_exists()
    {
        $view = $this->blade(
            '<x-work-in-progress />'
        );

        $view->assertSee('id="wip"', false);
    }

    /**
     * @test
     */
    public function blog_componenet_exists()
    {
        $view = $this->component(Blog::class,['feed' => $this->feed]);

        $view->assertSee('id="blog"', false);
    }

    /**
     * @test
     */
    public function carosel_componenet_exists()
    {
        $view = $this->blade(
            '<x-carosel id="books" class="carosel" />'
        );

        $view->assertSee('class="carosel"', false);
    }
}
