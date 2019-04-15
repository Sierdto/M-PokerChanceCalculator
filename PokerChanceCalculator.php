<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/index.css">
</head>
<div style="margin-top: 100px; margin-bottom: 10px" class="container">
	<div id="centerenCols" class="form-group">
		<form method="POST">
			<?php
			
				//include the card and HTMLinput controller
				include ("controllers/cardController.php");
				include ("controllers/HTMLinputController.php");
				$cardController = new cardController();
				$HTMLinputController = new HTMLinputController();
				
				//get the cards
				$clubsCards = $cardController->loadClubs();
				$spadesCards = $cardController->loadSpades();
				$heartCards = $cardController->loadHearts();
				$diamondCards = $cardController->loadDiamond();
				
				//the total number of cards in the play
				$totalNumberCards = $cardController->getTotalNumberOfCards();

				//get the length of the array's
				$clubsSpadesDeckLength = $cardController->calculateTheBlackDeckLength();
				$heartDiamondDeckLength = $cardController->calculateTheRedDeckLength();
				
				//the not yet defined length of the deck
				$deckLength = 0;
				
				//determine the deckLength!
				if($clubsSpadesDeckLength === $heartDiamondDeckLength) {
					$deckLength = $heartDiamondDeckLength;
					
				} else if($clubsSpadesDeckLength > $heartDiamondDeckLength) {
					
					//clubs and spades has more cards, so pick the hearts and diamond one
					$deckLength = $heartDiamondDeckLength;
					
				} else if($clubsSpadesDeckLength < $heartDiamondDeckLength) {
					
					//heart and diamond has more cards, so pick the clubs and spades one
					$deckLength = $clubsSpadesDeckLength;
				}
				
				//only show if the suit has not been chosen yet
				if(!(isset($_POST['chosenCardColor'])) && !(isset($_POST['chosenCard'])) && !(isset($_POST['pickedCard']))) {
					
					//let the user choose between a suit
					echo $HTMLinputController->theSuitInput();
				}
				
				//only show if the suit has been chosen, but the 'chosen' card is still unknown
				if(isset($_POST['chosenCardColor']) && !(isset($_POST['chosenCard'])) && !(isset($_POST['pickedCard']))) {
					
					if(isset($_POST['red'])) {
						
						//get some input fields so the user can choose between hearts or diamonds for the 'chosen' card
						echo $HTMLinputController->chooseTheCardInput($deckLength, $heartCards, $diamondCards);
						
					} else if(isset($_POST['black'])) {
						
						//get some input fields so the user can choose between clubs or spades for the 'chosen' card
						echo $HTMLinputController->chooseTheCardInput($deckLength, $clubsCards, $spadesCards);
					}
				}
				
				//card has been chosen or/and they have picked a card who they think is their card
				if(isset($_POST['chosenCard']) || isset($_POST['pickedCard'])) {
						if(isset($_POST['pickedCard'])) {
							
							//found the card!
							if($_POST['chosenCard'] === $_POST['pickedCard']) {
								$chanceToFindCard = 0;
								
								if(isset($_POST['alreadyPickedCards'])) {
									
									//count how many cards have already been chosen
									$alreadyPickedCards = unserialize(base64_decode($_POST['alreadyPickedCards']));
									$lengthPickedCards = $cardController->getAmountOfCardsChosen($alreadyPickedCards);;

									//the total of cards left
									$totalNumberCards -= $lengthPickedCards;
									
									$chanceToFindCard = $cardController->calculateChanceOfFindingCard($totalNumberCards);
								} else {
									//only one card needed to find the right card, so no need to update the total nuber of cards						
									$chanceToFindCard = $cardController->calculateChanceOfFindingCard($totalNumberCards);
								}
								
								//return a alert with the chance to find
								echo $HTMLinputController->foundItMessage($chanceToFindCard);
								
								//refresh page and exit script
								header("Refresh: 0");
								exit();
							}

							//the picked card
							$pickedCard = $_POST['pickedCard'];
						
							if(isset($_POST['alreadyPickedCards'])) {
								
								$alreadyPickedCards = unserialize(base64_decode($_POST['alreadyPickedCards']));

								//push the card into the array
								array_push($alreadyPickedCards, $pickedCard);
								
								//copy the array
								$pickedCards = $alreadyPickedCards;
								
								echo $HTMLinputController->hiddenInputPickedCards($alreadyPickedCards);
							} else {
								//first time user picked a card
								$pickedCard = array($pickedCard);
								
								//create the pickedCards array
								$pickedCards = array($_POST['pickedCard']);
								
								echo $HTMLinputController->hiddenInputPickedCards($pickedCard);
							}
							
							//coutn how big the pickedcards array is
							$pickedDeckLength = count($pickedCards);
							
							//unset the cards that have already been chosen
							for($j=0; $j < $pickedDeckLength; $j++) {
								foreach (array_keys($heartCards, $pickedCards[$j]) as $key) {
									unset($heartCards[$key]);
								}
								foreach (array_keys($diamondCards, $pickedCards[$j]) as $key) {
									unset($diamondCards[$key]);
								}
								foreach (array_keys($clubsCards, $pickedCards[$j]) as $key) {
									unset($clubsCards[$key]);
								}
								foreach (array_keys($spadesCards, $pickedCards[$j]) as $key) {
									unset($spadesCards[$key]);
								}
							}
						}
					
					//inform the user to pick cards untill they find the chosen card
					echo $HTMLinputController->informToPickCards($_POST['chosenCard']);
					
					//shuffle the deck array's for the random cards
					shuffle($clubsCards);
					shuffle($spadesCards);
					shuffle($diamondCards);
					shuffle($heartCards);
					
					for($i=0; $i <= $deckLength; $i++) {
						
						//only thing not random is: always, clubs first, then spades, then diamonds and then hearts
						if(isset($clubsCards[$i])) {
							echo $HTMLinputController->createCardsToPickFrom($clubsCards[$i]);
						}
						if(isset($spadesCards[$i])) {
							echo $HTMLinputController->createCardsToPickFrom($spadesCards[$i]);
						}
						if(isset($diamondCards[$i])) {
							echo $HTMLinputController->createCardsToPickFrom($diamondCards[$i]);
						}
						if(isset($heartCards[$i])) {
							echo $HTMLinputController->createCardsToPickFrom($heartCards[$i]);
						}
					}
					
					echo $HTMLinputController->hiddenInputChosenCard($_POST['chosenCard']);
				}
			?>
		</form>
	</div>
</div>