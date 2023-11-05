<?php

namespace App\Http\Controllers;

use App\Models\Cafes;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;



class CafesController extends Controller
{

    public function viewcafe()
    {
        $cafes = Cafes::all(); // Retrieve all records from the database
        return view('cafes.viewcafe', compact('cafes'));
    }


    public function createcafe()
    {       
        return view('cafes.createcafe');
    }
    


    public function storecafe(Request $request)
    {

        // Validations
        $request->validate([
            'name'               => 'required',
            'student_number'     => 'required|unique:records,student_number',
            'batch_number'       => 'required',
            'email'              => 'nullable|unique:records,email',
            'mobile_number'      => 'nullable|numeric|digits:10',

        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $cafe = Cafes::create([
                'name'              => $request->name,
                'student_number'    => $request->student_number,
                'batch_number'      => $request->batch_number,
                'email'             => $request->email,
                'mobile_number'     => $request->mobile_number,
            ]);


            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('cafes.viewcafe')->with('success','Cafe Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function editcafe(Cafes $cafe)
    {
        return view('cafes.editcafe', compact('cafe'));
    }


    public function updatecafe(Request $request, Cafes $cafe)
        {
            // Validations
            $request->validate([
                'name'           => 'required',
                'address'        => 'required',
                'mobile_number'  => 'nullable|numeric|digits:8',

            ]);

            DB::beginTransaction();
            try {
                // Update Data
                $cafe->update([
                    'name'           => $request->name,
                    'address'        => $request->address,
                    'mobile_number'  => $request->mobile_number,
                ]);

                // Commit And Redirected To Listing
                DB::commit();
                return redirect()->route('cafes.viewcafe')->with('success', 'Cafe Updated Successfully.');
            } catch (\Throwable $th) {

                // Rollback and return with Error
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', $th->getMessage());
            }
        }


        public function destroy(Cafes $cafe) {
            
            if ($cafe->trashed()) {
                $cafe->forceDelete();
                return redirect()->route('cafes.archive')->with('error', 'Cafe permanently deleted!');
            }
            
            $cafe->delete();

            //DB::commit();
            
            return redirect()->route('cafes.viewcafe')->with('error', 'Cafe moved to archives successfully!');
        }

        public function archive(){
            $cafes = Cafes::onlyTrashed()->get();
            return view('cafes.archive', compact('cafes')); 
        }



        public function restore(Request $request) {
            $cafe = Cafes::where('id', $request->id)
            ->withTrashed()
             ->first();

             $update = Cafes::where('id', $request->id)
            ->restore();

            return redirect()->route('cafes.archive')->with('success', 'Cafe Restored!');

        }


        public function importCafes() {

            return view('cafes.import');
         }

       public function uploadCafes(Request $request) {

            Excel::import(new CafesImport, $request->file);
            return redirect()->route('cafes.viewcafe')->with('success', 'Cafes Imported Successfully!');

        }



        public function exportCafes() {
            $currentDate = Carbon::now()->format('Y-m-d'); // Get the current date in the desired format
            $fileName = 'cafes_' . $currentDate . '.xlsx'; // Create the new file name with the current date
        
            return Excel::download(new CafesExport, $fileName);
        }




}
