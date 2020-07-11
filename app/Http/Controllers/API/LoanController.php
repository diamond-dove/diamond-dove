<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoan;
// use App\Http\Resources\ClientCollection;
use App\Model\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        //
        return response([],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoan $request)
    {
        //
        $loan = Loan::create($request->all());
        $loan->client_id = $request->client_id;
        $loan->user_id = Auth::guard()->user()->id;
        $loan->save();

        return response([
            'message' => 'Loan created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
        return response([
            'loan' => $loan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLoan $request, Loan $loan)
    {
        //
        $loan->update($request->all());
        return response([
            'message' => 'Loan updated successfully'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
