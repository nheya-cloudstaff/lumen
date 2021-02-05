<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function showAllTickets()
    {
        return response()->json(Ticket::all());
    }

    public function showOneTicket($id)
    {
        return response()->json(Ticket::find($id));
    }

    public function create(Request $request)
    {
      $this->validate($request, [
          'name' => 'required',
          'content' => 'required'
      ]);

      $ticket = Ticket::create($request->all());

      return response()->json($ticket, 201);
    }

    public function update($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return response()->json($ticket, 200);
    }

    public function delete($id)
    {
        Ticket::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
