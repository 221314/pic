<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//라우트 규칙 수정(URI 수정)
$route['default_controller'] = 'topic/index'; //아무런 패스도 입력받지 않았을때 디폴트로 표시할 페이지
$route['404_override'] = 'errors/notfound'; //존재하지 않는 페이지에 접속시 표시할 페이지

$route['topic/(:num)'] = "topic/get/$1";
//		class-name/숫자가 붙으면 = class-name/function-name/숫자를 $1으로 치환하라는 규칙
$route['post/(:num)'] = "topic/get/$1";
//		class-name에 'post'가 들어와도 topic/get/$1 으로 치환하라는 규칙
$route['topic/([a-z]+)/([a-z]+)/(\d+)'] = "$1/$2/$3";
//		정규표현식:()안에 작성한다. []범위 \d는 숫자를 뜻함
//		class-name/[a-z사이의 알파벳]중 한 개 이상 일치한다면/ ″ /숫자 중 한 개 이상 일치한다면 = $순서대로 대입 치환
