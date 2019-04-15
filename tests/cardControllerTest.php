<?php

class cardControllerTest extends PHPUnit_Framework_TestCase
{
    public function testCalculateChanceOfFindingCard() {
		
		//52 = max cards (normally)
		$numberTest1 = number_format(1 * 100 / 52, 2);
		
		//4 cards left
		$numberTest2 = number_format(1 * 100 / 4, 2);
		
		//2 cards left
		$numberTest3 = number_format(1 * 100 / 2, 2);

		$this->assertSame('1.92', $numberTest1);
		$this->assertSame('25.00', $numberTest2);
		$this->assertSame('50.00', $numberTest3);
	}
	
	public function testCalculateTheRedDeckLength() {
		
		//13 cards are normal
		// $heartLength = 13;
		// $diamondLength = 13;
		
		//someone added a card to much
		// $heartLength = 14;
		// $diamondLength = 13;
		
		//someone removed a card!
		$heartLength = 12;
		$diamondLength = 13;

		if($heartLength === $diamondLength) {
			//first option goes here
			$this->assertSame($heartLength, $diamondLength);
			
		} else if($heartLength > $diamondLength) {
			//second option goes here
			$this->assertNotSame($heartLength, $diamondLength);
			
		} else if($heartLength < $diamondLength) {
			//third options goes here
			$this->assertNotSame($heartLength, $diamondLength);
		}

		
	}
}
?>