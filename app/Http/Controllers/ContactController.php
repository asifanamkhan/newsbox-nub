<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = DB::table('contacts')
                    ->orderBy('id', 'DESC')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return $data->name;
                    })
                    ->addColumn('email', function ($data) {
                        return $data->email;
                    })
                    ->addColumn('phone', function ($data) {
                        return $data->phone;
                    })
                    ->addColumn('subject', function ($data) {
                        return $data->subject;
                    })
                    ->addColumn('message', function ($data) {
                        return $data->message;
                    })

                    ->rawColumns(['name', 'email', 'phone','subject','message'])
                    ->make(true);
            }
            return view('back-end.users.contactus');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }

    public function contactUs(){
        try {
            return view('front-end.pages.contact.create');
        } catch (\Exception $exception) {
            return back()->with($exception->getMessage());
        }
    }

    public function contactCreate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ], []);
        try {

            DB::table('contacts')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('/')
                ->with('success', 'Successfully Submited');
        } catch (\Exception $exception) {

            return redirect()->back()->with('error', $exception->getMessage());
        }

    }
}
