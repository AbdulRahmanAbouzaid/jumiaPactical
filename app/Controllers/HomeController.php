<?php
namespace App\Controllers;

use App\Models\Customer;

class HomeController
{
	/**
	 * Show home page
	 *
	 * @return void
	 */
	public function index()
	{
		try {
			$page = $_GET['page'] ?? 1;

			if (isset($_GET['countryCode']) || isset($_GET['state'])) {
				$customers = Customer::search([
					'countryCode' => $_GET['countryCode'] ?? '',
					'state' => $_GET['state'] ?? '',
				], $page);
				require 'views/table.view.php';
			} else {
				$customers = Customer::getAll($page);
				require 'views/index.view.php';
			}
		} catch (\Exception $e) {
			return $e->getMessage();
		}
		
	}

	/**
	 * TODO LIST
	 * Code Refactor
	 */
}
