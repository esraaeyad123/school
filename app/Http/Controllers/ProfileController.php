<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\User;

class ProfileController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	
    	$user = auth()->user();

        $tracks = $user->tracks;

    	return view('/profile', compact('user', 'tracks'));
    }

    public function update_image(Request $request){

	    $user=auth()->user();
	    $photoable_type='App\User';
        $photoable_id= $user->id ;

        if($image = $request->file('image')){
           $file_to_store = time().'_'.$user->name.'_'.'_'.$image->getClientOriginalExtension();
          $user->photo()->create(['filename'=> $file_to_store ,'photoable_id'=> $photoable_id , 'photoable_type'=> $photoable_type ]);
           $image->move(public_path('image'),$file_to_store);
        }

        return response()->json([
            'message' => 'Your profile image successfully uploaded',
            'uploaded_image' => '<img src="/images/'. $file_to_store .'" class="img-thumbnail img-fluid">'
        ]);


    }

}
