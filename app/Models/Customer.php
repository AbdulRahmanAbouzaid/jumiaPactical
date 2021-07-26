<?php
namespace App\Models;

use App\Helpers\Data;
use App\SQLiteConnection;

class Customer {
    const TABLE = 'customer';
    const LIMIT = 10;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var Country
     */
    private $country;

    /**
     * Constructor
     *
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
        $this->country = new Country;
    }

    /**
     * Get All Datae
     *
     * @return array
     */
    public static function getAll($page)
    {
        $pdo = (new SQLiteConnection())->connect();
        $offset = ($page - 1) * self::LIMIT;
        $stmt = $pdo->query("select * from ". self::TABLE . " LIMIT " . $offset . "," . self::LIMIT);
        $customers = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = new self($row['phone']);
        }

        return $customers;
    }

    /**
     * Search In Customer table by code and state
     *
     * @param array $searchCriteria
     * @return array
     */
    public static function search(array $searchCriteria, $page)
	{
        $pdo = (new SQLiteConnection())->connect();
        $queryParts[] = "SELECT * FROM " . self::TABLE;
		if ($searchCriteria['countryCode']) {
            $isFilteredByCode = true;
            $queryParts[] =  "WHERE regexp_like('/\({$searchCriteria['countryCode']}\)/', phone)";
		}

        if ($searchCriteria['state']) {
            $queryParts[] = $isFilteredByCode ? 'AND' : 'WHERE';
            $regex = $isFilteredByCode ? Data::COUNTRIES_LIST[$searchCriteria['countryCode']]['regex'] 
                : implode('|', array_column(Data::COUNTRIES_LIST, 'regex'));

            $queryParts[] = $searchCriteria['state'] === 'nok' ? "NOT" : '';
            $queryParts[] = "regexp_like('/{$regex}/', phone)";
		}

        $offset = ($page - 1) * self::LIMIT;
        $queryParts[] =  " LIMIT " . $offset . "," . self::LIMIT;

        $stmt = $pdo->query(implode(' ', $queryParts));
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $customers[] = new self($row['phone']);
        }

		return $customers;
		
	}

    /**
     * Get customer's phone number
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get Customer's country
     *
     * @return Country
     */
    public function getCountry()
    {
        $this->country->setCode($this->phone);
        return $this->country;
    }

    /**
     * Get phone state
     *
     * @return string
     */
    public function getPhoneState()
    {
        $regex = $this->country->getRegex();
        return preg_match("/{$regex}/", $this->phone) ? "ok" : "nok";
    }
}