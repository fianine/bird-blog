<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\User;
use App\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAddNewArticle()
    {
        Storage::fake('image');

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('secret.addArticle'), [
            'author' => $user->name,
            'title' => 'Article Test',
            'slug' => str_slug('Article Test', '-'),
            'image' => UploadedFile::fake()->image('image.jpg'),
            'content' => '<p>Article content</p>',
            'status' => 'publish'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('secret.articles'));
    }

    public function testUpdateArticleWithImage()
    {
        Storage::fake('image');

        $user = factory(User::class)->create();

        $article = factory(Article::class)->create([
            'title' => 'Article Test Update',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'content' => 'Article Content data',
            'status' => 'publish'
        ]);

        $response = $this->actingAs($user)->post(route('secret.editArticle', ['id' => $article->id]), [
            'author' => $user->name,
            'title' => 'Article Update Success',
            'slug' => str_slug('Article Update Success', '-'),
            'image' => UploadedFile::fake()->image('image.jpg'),
            'content' => '<p>Article content</p>',
            'status' => 'draft'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('secret.articles'));
    }

    public function testUpdateArticleWithoutImage()
    {
        Storage::fake('image');

        $user = factory(User::class)->create();

        $article = factory(Article::class)->create([
            'title' => 'Article Test Update',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'content' => 'Article Content data',
            'status' => 'publish'
        ]);

        $response = $this->actingAs($user)->post(route('secret.editArticle', ['id' => $article->id]), [
            'author' => $user->name,
            'title' => 'Article Update Success',
            'slug' => str_slug('Article Update Success', '-'),
            'content' => '<p>Article content</p>',
            'status' => 'draft'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('secret.articles'));
    }

    public function testDeleteArticle()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create([
            'status' => 'publish'
        ]);

        $response = $this->actingAs($user)->delete(route('secret.deleteArticle', ['id' => $article->id])); 

        $response->assertStatus(302);
    }
}
