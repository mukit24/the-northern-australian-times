<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function articleList()
    {
        $articles = Article::with('user')->latest()->get();
        return view('article.article_list', compact('articles'));
    }

    public function articleDetails($id)
    {
        $article = Article::with('user')->with('comments')->findOrFail($id);
        return view('article.article_details', compact('article'));
    }

    public function displayCreateArticle() {
        if (!auth()->check()) {
            return redirect('/login');
        }

        return view('article.create_article');
    }

    public function createArticle(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tag' => 'required',
        ]);

        if($request->hasFile('image')){
            $incomingFields['image'] = basename($request->file('image')->store('public/images'));
        }

        $incomingFields['user_id'] = auth()->id();
        Article::create($incomingFields);
        return redirect('/articles')->with('message', 'Article is successfully published!');
    }

    public function displayEdit($id) {
        $article = Article::with('user')->findOrFail($id);
        if (auth()->user()->id !== $article['user_id']) {
            return redirect('/');
        }

        return view('article.edit_article', ['article' => $article]);
    }

    public function editArticle($id, Request $request) {
        $article = Article::with('user')->findOrFail($id);
        if (auth()->user()->id !== $article['user_id']) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'tag' => 'required',
        ]);

        if($request->hasFile('image')){
            $incomingFields['image'] = basename($request->file('image')->store('public/images'));
        }

        $article->update($incomingFields);
        return redirect()->route('articleDetails',$article->id);
    }


    public function deleteArticle($id) {
        $article = Article::with('user')->findOrFail($id);
        if (auth()->user()->id === $article['user_id']) {
            $article->delete();
            return redirect('/articles')->with('message', 'Delete');
        }
        elseif(auth()->user()->is_admin === 1){
            return redirect('/articles')->with('message', 'Delete');
        }
        else{
            return redirect('/');
        }
    }


    public function createComment(Request $request, $id) {
        $incomingFields = $request->validate([
            'username' => 'required',
            'body' => 'required',
        ]);

        $incomingFields['article_id'] = $id;
        Comment::create($incomingFields);
        return redirect()->route('articleDetails', $id);
    }


}
