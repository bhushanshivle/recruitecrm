<?php

namespace App\Http\Controllers;

use App\Candidate;
use Illuminate\Http\Request;
use App\Http\Helper\ResponseHelper;

class CandidateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //
    }

    public function showAllCandidates() {

        try {
            $data = Candidate::paginate(5);
            $intStatus = 200;
            $strMessage = "Candidates listed successfully";
        } catch( \Exception $e ) {
            throw $e;
        }

        return ResponseHelper::result( $intStatus, $strMessage, $data );
    }

    public function showCandidateById($id) {

        try {
            $intStatus = 200;
            $strMessage = "Candidate Not Found";
            $data = Candidate::find($id);
            if( $data ) {
                $strMessage = "Candidate Found";
            }
           
        } catch( \Exception $e ) {
            throw $e;
         }

         return ResponseHelper::result( $intStatus, $strMessage, $data  );
    }

    public function searchCandidates( Request $request ) {

        try {

            $arrmixWhereConitions = [];

            if( $request->input('first_name') ) {
            $arrmixWhereConitions[]= [ 'first_name', 'LIKE', '%' . $request->input('first_name') . '%' ];
            }

            if( $request->input('last_name') ) {
            $arrmixWhereConitions[]= [ 'last_name', 'LIKE', '%' . $request->input('last_name') . '%' ];
            }
            if( $request->input('email') ) {
            $arrmixWhereConitions[]= [ 'email', 'LIKE', '%' . $request->input('email') . '%' ];
            }
            $strMessage = "Search return no data";
            $data = Candidate::where( $arrmixWhereConitions )->paginate();
            $intStatus = 200;

            if( $data ) {
                $strMessage = "Candidates listed successfully";
            }
           
        } catch( \Exception $e ) {
            throw $e;
        }

        return ResponseHelper::result( $intStatus, $strMessage, $data );
    }
    
    public function createCandidate( Request $request ) {
               try {
                $this->validate( $request,
                [
                    'first_name' => 'required|max:40',
                    'last_name' => 'max:40',
                    'email' => 'email|max:100',
                    'contact_number' => 'max:100',
                    'specialization' => 'max:200',
                    'work_ex_year' => 'max:30',
                    'address' => 'max:500'
                ]
                );
             
                $objCandidate = new Candidate;
                $objCandidate->first_name = $request->input('first_name');
                $objCandidate->last_name = $request->input('last_name');
                $objCandidate->email = $request->input('email');
                $objCandidate->contact_number = $request->input('contact_number');
               
                $objCandidate->specialization = $request->input('specialization');
                $objCandidate->work_ex_year = $request->input('work_ex_year');

                if( false !== strtotime($request->input('candidate_dob')) ) {
                    $objCandidate->candidate_dob = strtotime($request->input('candidate_dob'));
                }
                $objCandidate->address = $request->input('address');

                if( 'male' == strtolower( $objCandidate->gender = $request->input('gender') ) ) {
                    $objCandidate->gender = 1;
                }

                if( 'female' == strtolower( $objCandidate->gender = $request->input('gender') ) ) {
                    $objCandidate->gender = 2;
                }

                if( $request->file('resume') ) {
                    $strDestinationPath = \storage_path('\uploads\\');
                    $strFilename = $request->file('resume')->getClientOriginalName();
                    $objTargetFile = $request->file('resume')->move( $strDestinationPath, $strFilename );
                    $objCandidate->resume = $strFilename;
                }
               
                $result = $objCandidate->save();
                $intStatus = 201;
                $strMessage = "Candidate saved successfully";
               } catch( \Exception $e ) {
                    throw $e;
               }
               return ResponseHelper::result( $intStatus, $strMessage );

    }
    
    //
}
