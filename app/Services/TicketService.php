<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TicketService
{

    /**
     * Create a info of user
     * 
     * @param Ticket $ticket 
     * @param array $input The user data
     * 
     * @return string The newly created data of the user
     */
    public function store(array $input)
    {
        $user = Auth::user();

        $input['user_id'] = $user->id;

        $ticket = Ticket::create($input);

        $datas = $input['datas'];

        foreach ($datas as $data) {

            $article = new Article();
            $article->name_article = $data["name_article"];
            $article->quantity = $data["quantity"];
            $article->unity_price = $data["unity_price"];
            $article->total = $data["total"];
            $article->notice = $data["notice"];
            $article->notice_doc = $data["notice_doc"];
            $article->garantie = $data["garantie"];
            $article->tuto = $data["tuto"];
            $article->reparation = $data["reparation"];
            $article->other_model = $data["other_model"];
            $article->revente = $data["revente"];
            $article->categories = $data["categories"];
            $article->user_id = $user->id;

            $etat = $ticket->articles()->save($article);
        }
        return $ticket;
    }




    /**
     * show a ticket
     * 
     * @param Ticket $ticket information of ticket
     * 
     * @return array
     */
    public function show(Ticket $ticket): array
    {
        return [
            'article' => $ticket->articles,
            'ticket' => $ticket->getAttributes()

        ];
    }


    /**
     * show a ticket
     * 
     * @param Ticket $ticket information of ticket
     * 
     * @return array
     */
    public function showByUser(User $user): array
    {

        $ticket = Ticket::user_id($user->id)->get();
        $ticket->load(['articles']);

        return [
            'ticket' => $ticket
        ];
    }



    /**
     * show a ticket
     * 
     * @param Ticket $ticket information of ticket
     * 
     * @return string
     */
    public function showTicketByMonth(User $user)
    {

        $ticket = Ticket::with('articles')->orderBy('created_at')->user_id($user->id)->get()->groupBy(function($data) {
            return Carbon::parse($data->created_at)->format('F');
        });

        return $ticket;
    }


    /**
     * show a ticket
     * 
     * @param Ticket $ticket information of ticket
     * 
     * @return array
     */
    public function showTicketByWeek(User $user): array
    {

        $ticket = Ticket::with('articles')->orderBy('created_at')->user_id($user->id)->get()->groupBy(function($data) {
            return Carbon::parse($data->created_at)->format('W');
        });

        return [
            'ticket' => $ticket
        ];
    }

    

        /**
     * show a ticket
     * 
     * @param Ticket $ticket information of ticket
     * 
     * @return array
     */
    public function filter($input, $user): array
    {

        $ticket = Ticket::with('articles')->filter($input)->user_id($user->id)->get();

        return [
            'ticket' => $ticket
        ];
    }


    /**
     * Update a user
     * 
     * @param Ticket $ticket the a ticket who updates his data
     * @param array $input The ticket data
     * 
     * @return void
     */
    public function update($dataToUpdate, $ticket)
    {

        $ticket->update($dataToUpdate);
    }



    /**
     * Delete a ticket
     * 
     * @param array $input The ticket id
     * 
     * @return void
     */
    public function delete($ticketToDelete)
    {

        $ticketToDelete->delete();

        $ticketToDelete->articles()->delete();
    }
}
