<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array("before" => "noauth"), function()
{
	Route::get("login", function()
	{
		return View::make("user.login")->with(array("title" => "Formulario de login"));
	});

	Route::get("register", function()
	{
		return View::make("user.register")->with(array("title" => "Formulario de registro"));
	});
});

Route::group(array("before" => "auth"), function()
{

	Route::get("dashboard", function()
	{
		$posts = Post::paginate(5);
		return View::make("platform.dashboard")
		->with(array("title" => "Bienvenido al blog", "posts" => $posts));
	});

	Route::get("newpost", function()
	{
		return View::make("platform.addPost")->with(array("title" => "Crear un nuevo post"));
	});

	Route::get("post/{id}", function($id)
	{
		$post = Post::find($id);
		return View::make("platform.post")
		->with(array("title" => $post->title , "post" => $post));
	});
});


Route::group(array("before" => "csrf"), function()
{
	Route::post("login", function()
	{
		$login = array(
			"email"		=>		Input::get("email"),
			"password"	=>		Input::get("password")
		);

		if(Auth::attempt($login))
		{
			return Redirect::to("dashboard");
		}
		else
		{
			return Redirect::to("login")->with(array("error_login" => "Email o contraseña incorrectos"));
		}
	});

	Route::post("register", function()
	{
		$registerData = array(
			"username"		=>		Input::get("username"),
			"email"			=>		Input::get("email"),
			"password"		=>		Hash::make(Input::get("password"))
		);
		
		$rules = array(
	        'username' 	=> 'required|min:2|max:100',
	        'email' 	=> 'required|email|min:6|max:100|unique:usuarios',
	        'password' 	=> 'required|confirmed|min:6|max:100'
	    );
		
		$messages = array(
	        'required' 	=> 'El campo :attribute es obligatorio.',
	        'min' 		=> 'El campo :attribute no puede tener menos de :min carácteres.',
	        'email' 	=> 'El campo :attribute debe ser un email válido.',
	        'max' 		=> 'El campo :attribute no puede tener más de :min carácteres.',
	        'unique' 	=> 'El email ingresado ya está registrado en el blog',
	        'confirmed' => 'Los passwords no coinciden'
	    );

	    $validation = Validator::make(Input::all(), $rules, $messages);

	    if($validation->fails())
	    {
	    	return Redirect::to('register')->withErrors($validation)->withInput();
	    }
	    else
	    {
	    	$user = new User($registerData);
	    	$user->save();
	    	if($user)
	    	{
	    		return Redirect::to("login")->with(array("confirm" => "Te has registrado correctamente"));
	    	}
	    }
	});

	Route::post("new", function()
	{
		$postData = array(
			"title"			=>		Input::get("title"),
			"body"			=>		Input::get("body"),
			"user_id"		=>		Auth::user()->id
		);
		
		$rules = array(
	        'title' 	=> 'required|min:5|max:100',
	        'body' 		=> 'required|min:10'
	    );
		
		$messages = array(
	        'required' 	=> 'El campo :attribute es obligatorio.',
	        'min' 		=> 'El campo :attribute no puede tener menos de :min carácteres.',
	        'max' 		=> 'El campo :attribute no puede tener más de :min carácteres.',
	    );

	    $validation = Validator::make(Input::all(), $rules, $messages);

	    if($validation->fails())
	    {
	    	return Redirect::to('newpost')->withErrors($validation)->withInput();
	    }
	    else
	    {
	    	$post = new Post($postData);
	    	$post->save();
	    	if($post)
	    	{
	    		return Redirect::to("dashboard")->with(array("createPost" => "Tu post ha sido creado correctamente"));
	    	}
	    }
	});

	Route::post("newcomment", function()
	{
		$commentData = array(
			"post_id"		=>		Input::get("postId"),
			"user_id"		=>		Auth::user()->id,
			"comment"		=>		Input::get("comment")
		);
		
		$rules = array(
	        'comment' 		=> 'required|min:10'
	    );
		
		$messages = array(
	        'required' 	=> 'El campo :attribute es obligatorio.'
	    );
		
		$validation = Validator::make(Input::all(), $rules, $messages);	
		//si falla la validación mandamos al formulario de crear posts
		//con los errores de la validación
		if ($validation->fails())
	    {
	        return Redirect::to('post/'.Input::get("postId"))->withErrors($validation)->withInput();
	    }
	    else
	    {
	        $newComment = new Comment($commentData);
			$newComment->save(); 

	        if($newComment)
	        {
	            return Redirect::to('post/'.Input::get("postId"))->with(array('createComment' => 'Tu comentario se ha creado correctamente.'));
	        }
	    }
	});
});

Route::get("logout", function()
{
	Session::flush();
	Auth::logout();
	return Redirect::to("login")->with(array("logout" => "Has cerrado sesión correctamente"));
});