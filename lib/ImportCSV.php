<?php

/**
* @author Reginaldo Junior
* Class test to resolve this problem
* (a) Use the attached schema to create a new table and fill it with the data from the CSV file
* (b) Put proper indices on the table for faster query.
*/

namespace App\Lib;

class ImportCSV
{

	public function importDataCSV()
	{
		$response = $this->readCSV('../data.csv');
		
		$response = $this->prepareData($response);
		
		return $this->saveData($response);
	}

	public function readCSV($csvFile)
	{
		$file_handle = fopen($csvFile, 'r');

		while (!feof($file_handle) ) {
			$line_of_text[] = fgetcsv($file_handle, 1024);
		}

		fclose($file_handle);

		return $line_of_text;
	}

	public function prepareData($data)
	{
		$response = [];
		
		foreach ($data as $i => $value) {
			$auxiliar = explode('	', $value[1]);
			
			$response[$i]['location']   = str_replace('\N	', '', $value[0]);
			$response[$i]['slug']	    = str_replace(' ', '', $auxiliar[0]);
			$response[$i]['population'] = $auxiliar[count($auxiliar) - 1];
		}

		return $response;
	}
	
	public function saveData($data)
	{
		$connection = new Connection;

		$stmt = $connection->conn->prepare('INSERT INTO population (location,slug,population) 
											 	  VALUES  (:location, :slug, :population)');

		foreach ($data as $item)
		{
			$population = array(
				'location' 	  => $item['location'],
				'slug'        => $item['slug'],
				'population'  => $item['population'],
			);

			$response = $stmt->execute($population);
		}

		return $response;
	}

}