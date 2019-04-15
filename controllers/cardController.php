<?php

class cardController {
				
	//black cards(clubs and spades)
	private static $clubsCards = array("C2", "C3", "C4", "C5", "C6", "C7", "C8", "C9", "C10", "CJ", "CQ", "CK", "CA");
	private static $spadesCards = array("S2", "S3", "S4", "S5", "S6", "S7", "S8", "S9", "S10", "SJ", "SQ", "SK", "SA");
	
	//red cards(hearts and diamonds)
	private static $heartCards = array("H2", "H3", "H4", "H5", "H6", "H7", "H8", "H9", "H10", "HJ", "HQ", "HK", "HA");
	private static $diamondCards = array("D2", "D3", "D4", "D5", "D6", "D7", "D8", "D9", "D10", "DJ", "DQ", "DK", "DA");
	
				
	/**
	 * Calculate and check how many black cards there are, this is needed before you pick a the 'chosen' card. 
	 * To avoid errors, it is necessary to check first the length of the array's and compare them.
	 * Preventing for loop errors. (could also do if with isset instead of two functions)
	 * 
	 * @return	the length of the clubs/spades array
	 */
	function calculateTheBlackDeckLength() {
		
		//the length of the array's
		$clubsLength = count(self::$clubsCards) - 1;
		$spadesLength = count(self::$spadesCards) - 1;
		
		//if the length is the same, just return the size of one of them
		if($clubsLength === $spadesLength) {
			
			return $clubsLength;
			
		} else if($clubsLength > $spadesLength) {
			
			//clubs has more cards, so pick the spadeslength	
			return $spadesLength;
			
		} else if($clubsLength < $spadesLength) {
			
			//spades has more cards, so pick the clubslength	
			return $clubsLength;
		}
	}
	
	/**
	 * Calculate the chance of finding the card the user had chosen in the beginning
	 * 
	 * @return	the chance of finding the right card
	 */
	function calculateChanceOfFindingCard($totalNumberCards) {
		
		return number_format(1 * 100 / $totalNumberCards, 2);
	}
	
	/**
	 * Same as the black card calculater.
	 * Calculate and check how many black cards there are, this is needed before you pick a the 'chosen' card. 
	 * To avoid errors, it is necessary to check first the length of the array's and compare them.
	 * Preventing for loop errors. (could also do if with isset instead of two functions)
	 * 
	 * @return	the length of the hearts/diamonds array
	 */
	function calculateTheRedDeckLength() {
		
		$heartLength = count(self::$heartCards) - 1;
		$diamondLength = count(self::$diamondCards) - 1;
		
		//if the length is the same, just return the size of one of them
		if($heartLength === $diamondLength) {
			
			return $heartLength;
			
		} else if($heartLength > $diamondLength) {
			
			//diamond has more cards, so pick the heartLength	
			return $heartLength;
			
		} else if($heartLength < $diamondLength) {
			
			//heart has more cards, so pick the diamondLength	
			return $diamondLength;
		}
	}
	
	/**
	 * count how many cards have already been chosen
	 * 
	 * @return	amount of cards already chosen
	 */
	function getAmountOfCardsChosen($alreadyPickedCards) {
		return count($alreadyPickedCards);
	}
	
	/**
	 * Get the club cards
	 * 
	 * @return	the clubs
	 */
	function loadClubs() {
		return self::$clubsCards;
	}
	
	/**
	 * Get the spade cards
	 * 
	 * @return	the spades
	 */
	function loadSpades() {
		return self::$spadesCards;
	}
	
	/**
	 * Get the heartCards
	 * 
	 * @return	the hearts
	 */
	function loadHearts() {
		return self::$heartCards;
	}
	
	/**
	 * Get the diamond cards
	 * 
	 * @return	the diamonds
	 */
	function loadDiamond() {
		return self::$diamondCards;
	}
	
	/**
	 * Calculate the total number of cards
	 * 
	 * @return	total number of cards
	 */
	function getTotalNumberOfCards() {
		
		// total number of cards
		$totalNumberCards = count(self::$spadesCards) + count(self::$clubsCards) + count(self::$heartCards) + count(self::$diamondCards);
		
		return $totalNumberCards;
	}
}




?>