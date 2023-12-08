<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Facades\ArticleFacade as ArticleService;
use Illuminate\Http\Request;


class ArticleController extends Controller {
   

   /**
     * @OA\Get(
     *     path="/articles/{article}",
     *      tags={"Article"},
     *      summary="Get article",
     *      description="Afficher les articles",
     *      * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un article."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="401"),
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *      ),     
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function show(Article $article) {

        $data = ArticleService::show($article);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    /**
     * @OA\Get(
     *     path="/articles/{user}/{ticket}",
     *      tags={"Article"},
     *      summary="Get ticket",
     *      description="Afficher les articles en fonction des utilisateurs et des tickets",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "ticket id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un ticket."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="401"),
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *      ),     
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function showTicketArticle(User $user, Ticket $ticket) {

        $data = ArticleService::showTicketArticle($user, $ticket);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

   /**
     * @OA\Get(
     *     path="/articles/users/{user}",
     *      tags={"Article"},
     *      summary="Get article",
     *      description="Afficher les tickets en fonction des utilisateurs",
     *      * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un articles."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="401"),
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *      ),     
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function showByUser(User $user) {
        $data = ArticleService::showByUser($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * @OA\Get(
     *     path="/articles/prices/{user}",
     *      tags={"Article"},
     *      summary="Get article",
     *      description="Afficher les articles en fonction des utilisateurs et des prix",
     * security={{"bearerAuth": {{}}}},
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un articles."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="401"),
     *      @OA\Property(property="message", type="string", example="Unauthenticated")
     *        )
     *      ),     
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function showByPrice(User $user) {
        $data = ArticleService::showByPrice($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


     /**
     * @OA\Delete(
     *      path="/api/articles/{id}",
     *      tags={"Article"},
     *      summary="delete articles",
     *      description="delete articles",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "articles id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *      
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="suppression d'un ticket."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function destroy(Article $article) {
        ArticleService::delete($article);

        return response()->json([
            'message' => 'article successfull delete'
        ], 202);
    }

}
