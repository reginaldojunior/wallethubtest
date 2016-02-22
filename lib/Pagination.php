<?php

/**
*
* @author Reginaldo Junior
* Class test to resolve this problem
* Given a string:
* 1,2,3,4,5,6
*
* Create a function that gets the numbers on the left and the right of the given element.
* Here are some expected outputs:
* 
* pagination(1); // array('prev' => null, 'next' => 2);
* pagination(2); // array('prev' => 1, 'next' => 3);
* pagination(6); // array('prev' => 5, 'next' => null);
* 
* please do so "without" making use of explode() since the string can be comprised of thousands of elements when * exploded and that would be slow on the memory. 
* only use string manipulation functions.
* 
*/

namespace App\Lib;

class Pagination
{
	protected $pages;
	protected $currentPage;
	protected $nextPage;
	protected $prevPage;

	public function setPages($in)
	{
		$this->pages = $in;
	}

	public function getPages()
	{
		return $this->pages;
	}

	public function getCurrentPage()
	{
		return $this->currentPage;
	}
	public function setCurrentPage($in)
	{
		$this->currentPage = $in;
	}

	public function getNextPage()
	{
		preg_match_all('!\d+!', $this->pages, $matches);		
		
		$length = count($matches);
		
		$this->nextPage = null;

		foreach ($matches[0] as $matche) {
			if ((int) $matche != ',' && (int) $matche > $this->currentPage)
			{
				$this->nextPage = $matche;
				break;
			}
		}

		return $this->nextPage;
	}

	public function getPrevPage()
	{
		preg_match_all('!\d+!', $this->pages, $matches);		
		
		$length = count($matches);
		
		$this->prevPage = null;

		foreach ($matches[0] as $matche) {
			if ((int) $matche != ',' && (int) $matche < $this->currentPage)
			{
				$this->prevPage = $matche;
			}
		}

		return $this->prevPage;
	}

	public function getPagination()
	{
		return ['prev' => $this->getPrevPage(), 'next' => $this->getNextPage()];
	}
}