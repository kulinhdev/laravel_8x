<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HttpRequestController extends Controller
{
	public function index(Request $request)
	{
		echo 'Path: ' . $request->path() . '<br />';
		echo 'Url: ' . $request->url() . '<br />';
		echo 'IP: ' . $request->ip() . '<br />';
		$inputValue =  $request->query('name', 'Linh');
		print_r($inputValue);
		echo '<br />';
		echo 'Name :' . $request->name;
		echo '<br />';
		// only <=> except
		// Show all input - except 'name' and 'age'
		$input = $request->except(['name', 'age']);
		print_r($input);
		echo '<br />';
		if ($request->has(['name'])) {
			echo 'Input name already exits !';
		}
		echo '<br />';
		$request->whenHas('name', function ($input) {
			echo 'Run if name exits and receive value of this name => '. $input;
		});
		echo '<br />';
		if ($request->filled('name')) {
			echo 'Input name exits and does not empty !';
		}
		echo '<br />';
		$request->whenFilled('name', function ($input) {
			echo 'Function run if name exits and does not empty ! => '.$input;
		});
		echo '<br />';
		if ($request->missing('address')) {
			echo 'Address is missing !';
		}
	}

	public function send(Request $request)
	{	
		return view('blog.add-blog');
	}

	public function receive(Request $request)
	{
		dd($request);
	}
	
}
