<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return "Start Lumen";
});

// Users
$router->get    ("/api/v1/users","UserController@showAll");
$router->get    ("/api/v1/users/{id}","UserController@show");
$router->post   ("/api/v1/users","UserController@save");
$router->put    ("/api/v1/users/{id}","UserController@update");
$router->delete ("/api/v1/users/{id}","UserController@delete");

// Post API
$router->post   ("/api/v1/post","PostController@save");
$router->post   ("/api/v1/postimages","PostController@imagestore");

// Pages
$router->get    ("/api/v1/pages/{userid}","PageController@index");
$router->get    ("/api/v1/pagefollowers","PageController@getPageFollowers");
$router->get    ("/api/v1/getpost","PageController@getPost");
$router->get    ("/api/v1/getpostimages/{url}","PageController@getPostImages");
// $router->get    ("/api/v1/getfollow/{postid}","PageController@getFollow");
// $router->get    ("/api/v1/getunfollow/{postid}","PageController@getUnFollow");

// Stories
$router->get    ("/api/v1/stroies/{userid}","StoriesController@getStories");
$router->post   ("/api/v1/stroiespost","StoriesController@stroiesSave");
$router->post   ("/api/v1/stroiesviewpost","StoriesController@stroiesViewSave");
$router->delete ("/api/v1/stroies/{id}","StoriesController@delete");

// Blog
$router->get    ("/api/v1/getblog","BlogController@getBlog");
$router->get    ("/api/v1/blog/{id}","BlogController@show");
$router->post   ("/api/v1/blogcommentpost","BlogController@save");
$router->post   ("/api/v1/blogpointpost","BlogController@pointSave");

// Apothecary Walls
$router->get    ("/api/v1/getwalls","ApothecaryWallsController@getWalls");

// Campaigns
$router->get    ("/api/v1/getcampaigns","CampaignsController@getCampaigns");

// Education
$router->get    ("/api/v1/geteducationcategory","EducationController@getEducationCategory");
$router->get    ("/api/v1/geteducation","EducationController@getEducation");

// Events
$router->get    ("/api/v1/getevents","EventsController@getEvents");

// News
$router->get    ("/api/v1/getnewscategory","NewsController@getNewsCategory");
$router->get    ("/api/v1/getnews","NewsController@getNews");
