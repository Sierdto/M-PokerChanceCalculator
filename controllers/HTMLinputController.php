<?php

class HTMLinputController {
	
	/**
	 * Gives back the option to choose between red or black
	 * 
	 */
	function theSuitInput() {
		
		echo 'First select a suit: </br>';
		echo '<input type="submit" class="cardColor" name="red" value="Red" id="red">';
		echo '<input type="submit" class="cardColor" name="black" value="Black" id="black">';
		echo '<input type="hidden" class="cardColor" name="chosenCardColor" id="cardColor">';
	}

	/**
	 * Gives back the option to choose a card from a deck
	 *
	 * @param	$deckLength the length of the deck
	 * @param	$deck1 		deck1 can be clubs or hearts
	 * @param	$deck2 		deck2 can be spades or diamonds
	 * 
	 */
	function chooseTheCardInput($deckLength, $deck1, $deck2) {
		
		echo 'Select a card from the deck: </br>';
		
		for($i=0; $i <= $deckLength; $i++) {
			echo "	<input type='submit' class='cards' name='chosenCard' value='".$deck1[$i]."' id='".$deck1[$i]."'>
					<input type='submit' class='cards' name='chosenCard' value='".$deck2[$i]."' id='".$deck2[$i]."'>
					</br>
				";
		}
	}
	
	/**
	 * Informs the user that he/she can pick cards until finds the chosen card
	 *
	 * @param	$chosenCard the users 'chosen' card
	 *  
	 */
	function informToPickCards($chosenCard) {
		
		echo "This is your chosen card: ". $chosenCard . "</br>";
		echo "Now lets pick cards until it matches your chosen card.</br>";
	}
	
	/**
	 * Returns a card wich the user can pick
	 *
	 * @param	$cards a string with the value of the card
	 *  
	 */
	function createCardsToPickFrom($cards) {
		echo "<input type='submit' class='noText' name='pickedCard' value='".$cards."' id='".$cards."'>";
	}
	
	/**
	 * Returns a hidden input field with the already picked cards
	 * Serializing it means the array will be transferred correctly to the $_POST
	 *
	 * @param	$chanceToFindCard array with the already picked cards
	 * 
	 */
	function hiddenInputPickedCards($pickedCard) {
		$pickedCard = base64_encode(serialize($pickedCard));
		echo "<input type='hidden' name='alreadyPickedCards' value='".$pickedCard."'>";
	}
	
	/**
	 * Returns a hidden input field with the chosen card
	 *
	 * @param	$chosenCard the card chosen by the user
	 * 
	 */
	function hiddenInputChosenCard($chosenCard) {
		echo "<input type='hidden' name='chosenCard' value='".$chosenCard."'>";
	}							
	
	/**
	 * Returns a alert with the chance to have found the users 'chosen' card
	 *
	 * @param	$chanceToFindCard the chance to have found the card
	 * 
	 */
	function foundItMessage($chanceToFindCard) {

		$founditMessage = "You found your chosen card! You had a ".$chanceToFindCard." % chance to find the card.";
		echo "<script type='text/javascript'>alert('$founditMessage');</script>";
	}

}
?>