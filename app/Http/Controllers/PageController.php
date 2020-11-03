<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class PageController extends Controller
{
    private $article;

    public function __construct(ArticleService $article)
    {
      $this->article = $article;
    }

   public function index()
   {
      $articles = $this->article->getArticles();
      return view('pages.index', compact('articles'));
   }

   public function read($slug)
   {
      $article = $this->article->getArticleBySlug($slug);
      return view('pages.read', compact('article'));
   }
}
