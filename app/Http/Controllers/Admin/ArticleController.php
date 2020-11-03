<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    private $article;

    public function __construct(ArticleService $article)
    {
      $this->article = $article;
    }

    public function index($admin = true)
    {
        $articles = $this->article->getArticles($admin);
        return view('admin.article.index', compact('articles'));
    }

    public function add(Request $request)
    {
        if(!$request->title){
            return view('admin.article.add');
        }else{
            $this->article->createArticle($request);
            return redirect(route('secret.articles'));
        }
    }

    public function edit(Request $request, $id)
    {
        if(!$request->title){
            $article = $this->article->getArticleById($id);
            return view('admin.article.edit', compact('id', 'article'));
        }else{
            $article = $this->article->updateArticle($id, $request);
            return redirect(route('secret.articles'));
        }
    }

    public function delete($id)
    {
        $article = $this->article->deleteArticle($id);
        return redirect(route('secret.articles'));
    }
    
}
