<?php

namespace app;

use app\core\BaseController;

/**
 * Class Controller
 * api goes here
 * @package app
 */
class Controller extends BaseController
{
    /** @var array $namesData - data extracted from the file data/names.php */
    private $namesData;

    /** @var array $electronsData - data extracted from the file data/electrons.php */
    private $electronsData;

    /** @var array $numbersData - data extracted from the file data/numbers.php */
    private $numbersData;

    /**
     * Get the full name of an element given it's symbol.
     * @return array
     */
    protected function getNames()
    {
        $names = $this->getNamesData();

        if(isset($this->request["elements"])) {
            $errorElements = [];
            // gets the element symbols from the URL
            $elements = explode(',', $this->request["elements"]);
            foreach ($elements as $index => $symbol) {
                if(in_array(ucfirst(strtolower($symbol)), array_keys($names))) {
                    $elements[$index] = ucfirst(strtolower($symbol));
                } else {
                    unset($elements[$index]);
                    array_push($errorElements, $symbol);
                }
            }
        } else {
            // if none were specified, just do all of them
            $elements = array_keys($names);
        }
        $result = [];
        // gets the names from $names and puts them in the final array
        foreach ($elements as $element) {
            $name = $names[$element];
            $result[$element] = $name;
        }
        // pops an error message in the $result
        if(isset($errorElements)) {
            foreach ($errorElements as $error) {
                $result[$error] = ["error" => "Invalid element!"];
            }
        }

        return $result;
    }

    /**
     * Alias for getElectrons
     * @see getElectrons
     */
    protected function getOrbitals()
    {
        return $this->getElectrons();
    }

    /**
     * Get the electronic configuration of an element given it's symbol.
     * @return array
     */
    protected function getElectrons()
    {
        $electrons = $this->getElectronsData();
        $numbers = $this->getNumbersData();

        if(isset($this->request["elements"])) {
            $errorElements = [];
            // gets the element symbols from the URL
            $elements = explode(',', $this->request["elements"]);
            foreach ($elements as $index => $symbol) {
                if(in_array(ucfirst(strtolower($symbol)), array_keys($electrons))) {
                    $elements[$index] = ucfirst(strtolower($symbol));
                } else {
                    unset($elements[$index]);
                    array_push($errorElements, $symbol);
                }
            }
        } else {
            // if none were specified, just do all of them
            $elements = array_keys($electrons);
        }
        $result = [];
        $atomicNumbers = [];
        // converts the symbols to atomic numbers (i could probably just use array_push() here, but i don't really care)
        foreach ($elements as $index => $symbol) {
            $atomicNumbers[$index] = $numbers[$symbol]["atomic"];
        }
        // calculates configurations & gets element blocks if requested
        foreach ($elements as $index => $element) {
            $result[$element]["config"] = electron_config($atomicNumbers[$index]);
            $result[$element]["short"] = electron_config($atomicNumbers[$index], true);
            if(isset($this->request["showBlocks"])) {
                if($this->request["showBlocks"]) {
                    $result[$element]["block"] = $electrons[$element]["block"];
                }
            }
        }
        // pops an error message in the $result
        if(isset($errorElements)) {
            foreach ($errorElements as $error) {
                $result[$error] = ["error" => "Invalid element!"];
            }
        }

        return $result;
    }

    /**
     * Get the atomic number of an element given it's symbol.
     * @return array
     */
    protected function getNumbers()
    {
        $electrons = $this->getElectronsData();
        $numbers = $this->getNumbersData();

        if(isset($this->request["elements"])) {
            $errorElements = [];
            // gets the element symbols from the URL
            $elements = explode(',', $this->request["elements"]);
            foreach ($elements as $index => $symbol) {
                if(in_array(ucfirst(strtolower($symbol)), array_keys($electrons))) {
                    $elements[$index] = ucfirst(strtolower($symbol));
                } else {
                    unset($elements[$index]);
                    array_push($errorElements, $symbol);
                }
            }
        } else {
            // if none were specified, just do all of them
            $elements = array_keys($numbers);
        }
        $result = [];
        // gets atomic numbers and possibly masses from $numbers, passes them to $resultsp
        foreach ($elements as $element) {
            $result[$element]["atomic"] = $numbers[$element]["atomic"];
            if(isset($this->request["mass"])) {
                if($this->request["mass"]) {
                    $result[$element]["mass"] = $numbers[$element]["mass"];
                }
            }
        }
        // pops an error message in the $result
        if(isset($errorElements)) {
            foreach ($errorElements as $error) {
                $result[$error] = ["error" => "Invalid element!"];
            }
        }

        return $result;
    }

    /**
     * ¯\_(ツ)_/¯
     * @return array
     */
    protected function getDankmemes()
    {
        return [69 => "( ͡° ͜ʖ ͡°)"];
    }

    /**
     * Extract and return data from file
     * @return array|mixed
     */
    private function getNamesData()
    {
        return isset($this->namesData)
            ? $this->namesData
            : ($this->namesData = require(BASE_PATH . '/data/names.php'));
    }

    /**
     * Extract and return data from file
     * @return array|mixed
     */
    private function getElectronsData()
    {
        return isset($this->electronsData)
            ? $this->electronsData
            : ($this->electronsData = require(BASE_PATH . '/data/electrons.php'));
    }

    /**
     * Extract and return data from file
     * @return array|mixed
     */
    private function getNumbersData()
    {
        return isset($this->numbersData)
            ? $this->numbersData
            : ($this->numbersData = require(BASE_PATH . '/data/numbers.php'));
    }
}
