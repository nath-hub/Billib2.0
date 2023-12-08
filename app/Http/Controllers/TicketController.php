<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Facades\TicketFacade as TicketService;


class TicketController extends Controller {


    /**
   * @OA\Post(
   *      path="/api/tickets",
   *      tags={"Ticket"},
   *      summary="Newly ticket",
   *      description="Nouveau ticket",
   *      * security={{"bearerAuth": {{}}}},    
   *  @OA\RequestBody(
   *      required=true,
   *      description="Enregistrement d'un nouveau ticket",
   *  @OA\JsonContent(
   *      @OA\Property(property="name_store", type="string", example="dov", description ="nom de votre magasin"),
   *      @OA\Property(property="phone", type="integer", example="678676568", description ="votre numero de téléphone"),
   *      @OA\Property(property="adresse", type="string", example="paris", description ="votre adresse"),
   *      @OA\Property(property="name_cashier", type="string", example="Lucia", description ="nom de la caissiere"),
   *      @OA\Property(property="total_payable", type="integer", example="10000", description ="total a payer"),
   *      @OA\Property(property="net", type="integer", example="11000", description ="votre net a payer"),
   *      @OA\Property(property="tva", type="integer", example="1000", description ="tva"),
   *      @OA\Property(property="number_ticket", type="integer", example="001", description ="votre numero de ticket"),
   *      @OA\Property(
   *          property="datas",
   *          type="array",
   *              @OA\Items(
   *                  type="object",
   *                  required={"name_article", "quantity", "unity_price", "total", "notice", "notice_doc", "garantie", "tuto", "reparation", "other_model", "revente", "categories"},
   *                  @OA\Property(property = "quantity", type="integer", example="100", description ="votre quantité d'article"),
   *                  @OA\Property(property = "name_article", type = "string", example="nutella", description ="votre nom d'article"),
   *                  @OA\Property(property = "unity_price", type = "integer", example="1000", description ="prix unitaire"),
   *                  @OA\Property(property = "total", type = "integer", example="10000", description ="votre total"),
   *                  @OA\Property(property = "notice", type = "string", example="https://notice.com", description ="votre notice"),
   *                  @OA\Property(property = "notice_doc", type = "string", example="https://notice-doc.com", description ="votre documentation de la notice"),
   *                  @OA\Property(property = "garantie", type = "string", example="https://garantie.com", description ="votre garantie"),

   *                  @OA\Property(property = "tuto", type = "string", example="https://tuto.com", description ="votre tuto"),
   *                  @OA\Property(property = "reparation", type = "string", example="https://reparation.com", description ="votre reparation"),
   *                  @OA\Property(property = "other_model", type = "string", example="https://other_model.com", description ="other_model"),
   *                  @OA\Property(property = "revente", type = "string", example="https://revente.com", description ="votre revente"),
   *                  @OA\Property(property = "categories", type = "string", example="shopping", description ="votre categories"),
   * 
   *                       )
   *                  ),
   *      ),
   *      ),
   *       @OA\Response(
   *      response=201,
   *      description="Success response",
   *      @OA\JsonContent(
   *      @OA\Property(property="status", type="number", example="200"),
   *      @OA\Property(property="message", type="string", example="ticket bien Creer."),
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
    public function store(TicketRequest $request) {

        $input = $request->validated();

        $data = TicketService::store($input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/tickets/{id}",
     *      tags={"Ticket"},
     *      summary="Get ticket",
     *      description="Get ticket",
     *      * security={{"bearerAuth": {{}}}},    
     *  @OA\Parameter(
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
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function show(Ticket $ticket) {
        $data = TicketService::show($ticket);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     *     path="/tickets/users/{user}",
     *      tags={"Ticket"},
     *      summary="Get ticket",
     *      description="Afficher les tickets en fonction des utilisateurs",
     *      * security={{"bearerAuth": {{}}}},     
     * @OA\Parameter(
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
    public function showByUser(User $user) {
        $data = TicketService::showByUser($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * @OA\Get(
     *     path="/tickets/month/{user}",
     *      tags={"Ticket"},
     *      summary="Get ticket",
     *      description="Afficher les tickets en fonction des utilisateurs classés par mois",
     *      * security={{"bearerAuth": {{}}}},    
     *  @OA\Parameter(
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
    public function showTicketByMonth(User $user) {
        $data = TicketService::showTicketByMonth($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    /**
     * @OA\Get(
     *     path="/tickets/week/{user}",
     *      tags={"Ticket"},
     *      summary="Get ticket",
     *      description="Afficher les tickets en fonction des utilisateurs classés par semaine",
     *      * security={{"bearerAuth": {{}}}},    
     *  @OA\Parameter(
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
    public function showTicketByWeek(User $user) {
        $data = TicketService::showTicketByWeek($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    /**
     * @OA\Post(
     *      path="/api/filter/{user}",
     *      tags={"Ticket"},
     *      summary="filter",
     *      description="selectionner les données en fonction des parametres entrés par l'utilisateur",
          * security={{"bearerAuth": {{}}}},
     *      @OA\RequestBody(
     *      required=true,
     *      description="Recherche d'un ticket",
     *  @OA\JsonContent(
     *      @OA\Property(property="name_store", type="string", example="dov", description ="nom de votre magasin"),
     *      @OA\Property(property = "name_article", type = "string", example="nutella", description ="votre nom d'article"),
     *      @OA\Property(property="categories", type="string", example="shopping", description ="votre adresse"),
     *      @OA\Property(property="unity_price", type="integer", example="10000", description ="total a payer"),
     *      @OA\Property(property="total", type="integer", example="11000", description ="votre net a payer"),
     *      ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="ticket bien Creer."),
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
    public function filter(TicketRequest $request, User $user) {

        $input = $request->validated();

        $data = TicketService::filter($input, $user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }




    /**
     * @OA\Put(
     *     path="/api/tickets/{id}",
     *      tags={"Ticket"},
     *      summary="Update ticket",
     *      description="Update ticket",
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
     *      @OA\Property(property="message", type="string", example="reponse de la modification"),
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
     *     response=401,
     *     description="Unauthenticated",
     *     @OA\JsonContent(
     *     @OA\Property(property="status", type="number", example="401"),
     *     @OA\Property(property="message", type="string", example="Unauthenticated")
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
    public function update(TicketRequest $request, Ticket $ticket) {
        $input = $request->validated();

        TicketService::update($input, $ticket);

        return response()->json([
            'message' => 'tickets successfull update'
        ], 202);
    }

    
    /**
     * @OA\Delete(
     *      path="/api/tickets/{id}",
     *      tags={"Ticket"},
     *      summary="delete ticket",
     *      description="delete ticket",
     * security={{"bearerAuth": {{}}}},
     * 
     *   @OA\Parameter(
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
    public function destroy(Ticket $ticket) {
        TicketService::delete($ticket);

        return response()->json([
            'message' => 'tickets successfull delete'
        ], 202);
    }
}
