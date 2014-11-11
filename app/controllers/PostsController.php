<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		$viewData = [
			'posts' => $posts,
			'pageTitle' => 'All Posts',
		];

		return View::make( 'posts.index', $viewData );
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
		$viewData = [
			'pageTitle' => 'Write New Post',
			'post' => new Post,
			'categories' => Category::lists( 'title', 'id' ),
		];

		return View::make( 'posts.create', $viewData );
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make( $data = Input::all(), Post::$rules );

		if ( $validator->fails() )
		{
			return Redirect::back()->withErrors( $validator )->withInput();
		}

		Post::create( $data );

		return Redirect::route( 'admin.posts.index' );
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

		return View::make('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified post in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id )
	{
		$post = Post::findOrFail( $id );

		$validator = Validator::make( $data = Input::all(), Post::$rules );

		if ( $validator->fails() )
		{
			return Redirect::back()->withErrors( $validator )->withInput();
		}

		$post->update($data);

		return Redirect::route( 'admin.posts.index' );
	}

	/**
	 * Remove the specified post from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $id )
	{
		Post::destroy( $id );

		return Redirect::route( 'admin.posts.index' );
	}

	public function getPostBySlug( $slug ) {
		// do validation

		$post = Post::where( 'slug', '=', $slug );

		if ( !$post ) {
			App::abort( 404 );
		}

		return Response::view( 'post.show', compact( $post ) );
	}

}