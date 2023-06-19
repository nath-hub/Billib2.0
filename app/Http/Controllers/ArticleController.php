<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Services\Facades\ArticleFacade as ArticleService;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {


          /**
     * @OA\Get(
     *      path="/api/show/{article}",
     *      operationId="show",
     *      tags={"Ticket"},
     *      summary="get un ticket",
     *      description="get un ticket",
     *     
     *		@OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "article id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *      ),
     *       @OA\Response(
     *      response=200,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="liste des tickets."),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     )
     * )
     *      
     * )
     */


        $data = ArticleService::show($article);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function showByUser(User $user)
    {
        $data = ArticleService::showByUser($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function showByPrice(User $user)
    {
        $data = ArticleService::showByPrice($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        ArticleService::delete($article);

        return response()->json([
            'message' => 'article successfull delete'
        ], 202);
    }
  
}
