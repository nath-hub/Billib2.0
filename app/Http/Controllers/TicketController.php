<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Facades\TicketFacade as TicketService;


class TicketController extends Controller
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
    public function store(TicketRequest $request)
    {


          /**
     * @OA\Get(
     *      path="/projects",
     *      operationId="getProjectsList",
     *      tags={"Projects"},
     *      summary="Get list of projects",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */


        $input = $request->validated();

        $data = TicketService::store($input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $data = TicketService::show($ticket);

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
        $data = TicketService::showByUser($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function showTicketByMonth(User $user)
    {
        $data = TicketService::showTicketByMonth($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function showTicketByWeek(User $user)
    {
        $data = TicketService::showTicketByWeek($user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }


        /**
     * Display the specified resource.
     */
    public function filter(TicketRequest $request, User $user)
    {

        $input = $request->validated();

        $data = TicketService::filter($input, $user);

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $input = $request->validated();

        TicketService::update($input, $ticket);

        return response()->json([
            'message' => 'tickets successfull update'
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        TicketService::delete($ticket);

        return response()->json([
            'message' => 'tickets successfull delete'
        ], 202);
    }
}
