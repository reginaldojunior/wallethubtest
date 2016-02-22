<?php

namespace App\Lib;

class PaginationTest extends \PHPUnit_Framework_TestCase
{

	protected $pagination;

	public function setUp()
	{
		$this->pagination = new Pagination;
	}

	public function testNextPageWithNumberOne()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(1);
		
		$this->assertEquals(2, $this->pagination->getNextPage());
	}

	public function testNextPageWithNumberTwo()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(2);
		
		$this->assertEquals(3, $this->pagination->getNextPage());		
	}

	public function testNextPageWithNumberSix()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(6);
		
		$this->assertEquals(null, $this->pagination->getNextPage());		
	}

	public function testPrevPageWithNumberOne()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(1);
		
		$this->assertEquals(null, $this->pagination->getPrevPage());
	}

	public function testPrevPageWithNumberTwo()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(2);
		
		$this->assertEquals(1, $this->pagination->getPrevPage());		
	}

	public function testPrevPageWithNumberSix()
	{
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(6);

		$this->assertEquals(5, $this->pagination->getPrevPage());		
	}

	public function testGetPaginationCurrentPageSix()
	{		
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(6);

		$this->assertEquals(['prev' => 5, 'next' => null], $this->pagination->getPagination());	
	}

	public function testGetPaginationCurrentPageOne()
	{		
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(1);

		$this->assertEquals(['prev' => null, 'next' => 2], $this->pagination->getPagination());	
	}

	public function testGetPaginationCurrentPageTwo()
	{		
		$this->pagination->setPages('1,2,3,4,5,6');
		
		$this->pagination->setCurrentPage(2);

		$this->assertEquals(['prev' => 1, 'next' => 3], $this->pagination->getPagination());	
	}

	public function testGetPaginationCurrentExtraTest()
	{		
		$this->pagination->setPages('1,2,3,4,5,6,7,8,9,10,11,12');
		
		$this->pagination->setCurrentPage(9);

		$this->assertEquals(['prev' => 8, 'next' => 10], $this->pagination->getPagination());	
	}

	public function testGetPrevPageAndNextPageExtraTest()
	{
		$this->pagination->setPages('1,2,3,4,5,6,11,12,13,16,18,19,25');
		
		$this->pagination->setCurrentPage(18);

		$this->assertEquals(16, $this->pagination->getPrevPage());				
		$this->assertEquals(19, $this->pagination->getNextPage());	
		$this->assertEquals(['prev' => 16, 'next' => 19], $this->pagination->getPagination());				
	}
}