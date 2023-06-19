<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;

class ArticleService
{

    /**
     * show a article
     * 
     * @param Article $article information of article
     * 
     * @return array
     */
    public function show(Article $article): array
    {
        return [
            'article' => $article
        ];
    }



    /**
     * show a article
     * 
     * @param Article $article information of article
     * 
     * @return array
     */
    public function showByUser(User $user): array
    {

        $article = Article::user_id($user->id)->get();

        return [
            'article' => $article
        ];
    }




    /**
     * show a article
     * 
     * @param Article $article information of article
     * 
     * @return array
     */
    public function showByPrice(User $user): array
    {
        
          $article = Article::user_id($user->id)
           
                ->orderBy('total')
                ->paginate(20)
                ->withQueryString();

        return [  
            'article' => $article
        ];
    }


    /**
     * Delete a article
     * 
     * @param array $input The article id
     * 
     * @return void
     */
    public function delete($articleToDelete)
    {

        $articleToDelete->delete();
    }
}
