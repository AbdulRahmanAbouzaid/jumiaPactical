<?php
namespace App\Models;

use App\Helpers\Data;

class Country {
    /**
     * @var string
     */
    private $code;

    /**
     * Set Country Code
     *
     * @param string $phone
     * @return void
     */
    public function setCode(string $phone)
    {
        foreach (Data::COUNTRIES_LIST as $code => $country) {
            if (preg_match('/\('.$code.'\)/', $phone)) {
                $this->code = $code;
                break;
            }
        }
         
    }

    /**
     * Get Country Code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get Country name
     *
     * @return string
     */
    public function getName()
    {
        return Data::COUNTRIES_LIST[$this->code]['name'];
    }

    /**
     * Get Country phone regex
     *
     * @return string
     */
    public function getRegex()
    {
        return Data::COUNTRIES_LIST[$this->code]['regex'];
    }
}