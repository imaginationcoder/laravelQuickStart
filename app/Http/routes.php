<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use laravelQuickStart\Task;
use laravelQuickStart\Post;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });


    /**
     * Blog posts----------------------------------------------------------------------
     */


    /**
     * Show Posts Dashboard
     */
    Route::get('/posts', function () {
        $posts = Post::orderBy('created_at', 'asc')->get();

        return view('posts', [
            'posts' => $posts
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/post', function (Request $request) {
        //
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/posts')
                ->withInput()
                ->withErrors($validator);
        }
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect('/posts');

    });

    /**
     * Delete Post
     */
    Route::delete('/post/{post}', function (Post $post) {
        $post->delete();

        return redirect('/posts');
    });

});
