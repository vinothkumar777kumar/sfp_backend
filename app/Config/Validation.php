<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $login = [
	'email' => [
		'rules' => 'required|valid_email',
	],
	'password' => [
		'rules' => 'required|min_length[8]|max_length[255]',
	]
	];

	public $register = [
		'name' => ['rules' => 'required|min_length[3]|max_length[20]',],
	'email' => [
		'rules' => 'required|valid_email|is_unique[students_tbl.email]',
	],
	'password' => [
		'rules' => 'required|min_length[8]|max_length[255]',
	],
	'mobile' => [
		'rules' => 'required|is_unique[students_tbl.mobile]',
	]
	];

}
