<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    function index()
    {
        return view('sistema.reserva.cadastraReserva');
    }

    function fetch(Request $request)
    {
        $hotel_id = auth()->user()->getHotelId();

        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('hospedes')
                ->where([
                    ['hotel_id', '=', $hotel_id],
                    ['nome', 'ILIKE', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li>Nome: ' . $row->nome.' ('.date('d/m/Y',strtotime($row->dataNascimento)).')</li>';
                $output .= "<input type='hidden' name='hospedeId' id='hospedeId' value='$row->id' >";

            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
