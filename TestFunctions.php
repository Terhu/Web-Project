<?php
		
	require_once("functions.php");
	
	class TestFunctions extends PHPUnit_Framework_TestCase
	{
		public function setUp()
		{
			echo "I run before each test \n";
		}
		
		public function testAddExistingName()
		{
			echo "Running testAdd with an already existing username \n";
			
			$name="user1";
			$res=user_search($name);
			$this->assertEquals(1,$res);
		}

		public function testAddNewName()
		{
			echo "Running testAdd with a new username \n";
			
			$name="new";
			$res=user_search($name);
			$this->assertEquals(0,$res);
		}

		
		public function testDeleteName()
		{
			echo "Running testDelete \n";
			
			$name="new";
			$res=user_delete($name);
			$this->assertEquals(1,$res);

		}

		
		public function tearDown()
		{
			echo "I run after each test \n";
		}

	}


?>
