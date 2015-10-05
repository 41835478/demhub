<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class FilesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Files Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'XmlController@');
	|
	*/

	public function uploadFiles(){
		if (Request::isMethod('post')){
			if(Input::hasFile('fileupload')){
				$file = array('file' => Input::file('fileupload'));
				$validator = Validator::make($file,
											array(
												'file' => 'required|max:5000|mimes:jpeg,JPG,jpg,JPEG,png,PNG,PDF,pdf'
												)
											);
				if ($validator->fails()){
				    // The given data did not pass validation
				    foreach ($messages->all() as $message){
					    //
					    Session::flash('error', $message);
					}
					return Redirect::url('files-manager');
				}
				else {
					if (Input::file('fileupload')->isValid()){
						$f = new Files;

						$destinationPath = public_path().'/user_files'; // upload path
						$extension = Input::file('fileupload')->getClientOriginalExtension(); // getting image extension
						$fileName = str_random(40).'.'.$extension; // re-name image
						$fileOriginalName = Input::file('fileupload')->getClientOriginalName();
						$fileSize = Input::file('fileupload')->getSize();


						Input::file('fileupload')->move($destinationPath, $fileName); // uploading file to given path

						$f->file_name = $fileName;
						$f->file_original_name = $fileOriginalName;
						$f->file_extension = $extension;
						$f->file_size = $fileSize;
						$f->user_id = Auth::user()->id;
						$f->hidden = false;
						$f->updated_at = app('currentDT');
						$f->created_at = app('currentDT');
						$f->save();


						// sending back with message
						Session::flash('success', 'Uploaded successfully!');

					}
					else {
						Session::flash('error', 'uploaded file is not valid');
					}

					return Redirect::url('files-manager');
				}
			}
			else {
				return Redirect::url('files-manager');
			}


		}
		else {
			Session::flash('error', "You clicked on a broken link");
			return Redirect::url('home');
		}
	}

	public function filesManager(){


		return view('user.filesmanager');
	}

	public function userFeedback(){
		if (Request::isMethod('post')){

		}
		else {
			return view('user.feedback');
		}
	}

	public function shareFile($id){
		$file = Files::where('id', '=', $id)
					->where('user_id', '=', Auth::user()->id)
					->first();
		$cats = Xmlcategories::all();

		if ($file){
			if (Request::isMethod('post')){
				$inputs = array(
							'Name' 			=> Request::input('fileshare-title'),
							'Description'	=> Request::input('fileshare-desc'),
							'Keywords'		=> Request::input('filesshare-keywords'),
							);

				$validator = Validator::make($inputs,
											array(
												'Name' 			=> 'required|max:100|min:3',
												'Description'	=> 'required|max:150|min:3',
											));
				if($validator->fails()){
					foreach ($validator->messages()->all() as $message){
					    //
					    Session::flash('error', $message);
					}
				}
				else {
					$create = new Xmlcategoryfeed;
					$create->category_id = Request::input('fileshare-category');
					$create->title = Request::input('fileshare-title');
					$create->link = url('user_files/'.$file->file_name);
					$create->desc = Request::input('fileshare-desc');
					$create->hidden = false;
					$create->pubDate = strtotime(app('currentDT'));
					$create->keywords = Request::input('fileshare-keywords');
					$create->updated_at = app('currentDT');
					$create->created_at = app('currentDT');
					$create->save();
					Session::flash('success', 'File shared successfully.');
				}

				return Redirect::back();
			}
			else {
				return view('user.filesshare')
							->with('file', $file)
							->with('cats', $cats);
			}
		}
		else {
			Session::flash('error', 'Looks like you clicked on a broken link!');
			return Redirect::url('files');
		}
	}
}
