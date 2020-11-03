<?php

namespace App\Services;

use App\Article;
use Validator;
use File;

class ArticleService 
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticles($admin = '')
    {
        if($admin == true){
            $articles = $this->article->orderBy('id', 'DESC')->get();
        }else{
            $articles = $this->article->orderBy('id', 'DESC')->where('status', 'publish')->get();
        }
        return $articles;
    }

    public function getArticleBySlug($slug)
    {
        $article = $this->article->where('slug', $slug)->firstOrFail();
        return $article;
    }

    public function createArticle($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
   
        if ($validator->fails()) {
            return $validator->errors();
        }

        $article = new Article;

        // Insert image thumbnail
        if(!empty($request->image)){
            $image = $request->file('image');
            $fileImage = time().'.'.$image->guessExtension();
            $path = $request->file('image')->move(base_path() . '/public/uploads/articles/thumbnail/', $fileImage);
        }

        // Insert content
        $content = $request->content;

        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/uploads/articles/content/" . time().$k.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $content = $dom->saveHTML();

        // Insert to database
        $article->author = Auth()->user()->name;
        $article->title = $request->title;
        $article->slug = str_slug($request->title, '-');
        $article->content = $content;
        $article->image = !empty($request->image) ? $fileImage : '';
        $article->status = $request->status;

        $article->save();
    }

    public function getArticleById($id)
    {
        $article = $this->article->where('id', $id)->firstOrFail();
        return $article;
    }

    public function updateArticle($id, $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);
   
        if ($validator->fails()) {
            return $validator->errors();
        }

        $article = Article::find($id);

        if($request->image){
            //Upload new image
            $image = $request->file('image');
            $fileImage = time().'.'.$image->guessExtension();
            $path = $request->file('image')->move(base_path() . '/public/uploads/articles/thumbnail/', $fileImage);

            // Insert content
            $content = $request->content;

            $dom = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
            $images = $dom->getElementsByTagName('img');

            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
                if(preg_match('/data:image/', $data)){
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/uploads/articles/content/" . time().$k.'.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();

            $article->author = Auth()->user()->name;
            $article->title = $request->title;
            $article->slug = str_slug($request->title, '-');
            $article->content = $content;
            $article->image = $fileImage;
            $article->status = $request->status;
        }else{
            // Insert content
            $content = $request->content;

            $dom = new \DomDocument();
            libxml_use_internal_errors(true);
            $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
            $images = $dom->getElementsByTagName('img');

            foreach($images as $k => $img){
                $data = $img->getAttribute('src');
                if(preg_match('/data:image/', $data)){
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/uploads/articles/content/" . time().$k.'.png';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();

            $article->author = Auth()->user()->name;
            $article->title = $request->title;
            $article->slug = str_slug($request->title, '-');
            $article->content = $content;
            $article->status = $request->status;
        }
        $article->save();
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);
        $article->delete();
    }
}