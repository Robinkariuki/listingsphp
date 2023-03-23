<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
 

class ListingController extends Controller
{
    //show all listings
    public function index(){
 
        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(6)
        ]);
    }
  // show single listing
  public function show(Listing $listing){
    return view('listings.show',[
        'listing'=> $listing
    ]);
  }


 //show create form
 public function create(){
    return view('listings.create');
 }

//store listing data
public function store(Request $request){
 $formFields = $request->validate([
    'title'=>'required',
    'company'=> ['required',Rule::unique('listings','company')],
    'location'=>'required',
    'website'=>'required',
    'email'=>['required','email'],
    'tags'=> 'required',
    'description'=>'required'

 ]);

   if($request->hasFile('logo')){
    $formFields['logo'] = $request->file('logo')->store('logos','public');
   }

   $formFields['user_id'] = auth()->id();

   Listing::create($formFields);
   
   return redirect('/')->with('message','Listing Created Successfully!');





}


//show Edit Form
public function edit(Listing $listing){
  
    return view('listings.edit',['listing'=>$listing]);
}


//update Listing Data
public function update(Request $request,Listing $listing){
    $formFields = $request->validate([
       'title'=>'required',
       'company'=> ['required'],
       'location'=>'required',
       'website'=>'required',
       'email'=>['required','email'],
       'tags'=> 'required',
       'description'=>'required'
   
    ]);
   
      if($request->hasFile('logo')){
       $formFields['logo'] = $request->file('logo')->store('logos','public');
      } 
   
      $listing->update($formFields);
      
      return back()->with('message','Listing updated Successfully!');
   
   
   }


   //Delete Listing
   public function destroy(Listing $listing){
    $listing->delete();
    return redirect('/')->with('message','Listing Deleted Successfully');
   }



   //Manage Listings
   public function manage(){
    return view('listings.manage',['listings'=> auth()->user()->listings()->get()]);
   }
}
