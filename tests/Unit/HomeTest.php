<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Article;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSeeHome()
    {
        $response = $this->get(route('page.home'));

        $response->assertSee('Areaikan Blog')
                 ->assertSee('Pusatnya ilmu pengetahuan tentang merawat dan budi daya ikan.');
    }

    public function testReadArticle()
    {
        $article = factory(Article::class)->create([
            'title' => 'test article',
            'slug' => str_slug('test article','-'),
            'status' => 'publish'
        ]);

        $response = $this->get(route('page.read', ['slug' => $article->slug]));

        $response->assertStatus(200)
                 ->assertSee($article->title);
    }
}
