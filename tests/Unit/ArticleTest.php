<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testSeeArticlesPage()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('secret.articles'));

        $response->assertSee('Articles');
    }

    public function testSeeAddArticlePage()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('secret.addArticle'));

        $response->assertSee('Add New Article')
                 ->assertSee('Write new article');
    }

    public function testSeeEditArticlePage()
    {
        $user = factory(User::class)->make();

        $article = factory(Article::class)->create([
            'status' => 'publish'
        ]);

        $response = $this->actingAs($user)->get(route('secret.editArticle', ['id' => $article->id]));

        $response->assertSee('Edit Article')
                 ->assertSee('Edit article')
                 ->assertSee($article->title)
                 ->assertSee($article->content)
                 ->assertSee($article->image);
    }

    public function testSeeEditArticlePageNotFound()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('secret.editArticle', ['id' => 1000000000]));

        $response->assertStatus(404);
    }
}
