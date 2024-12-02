<?php
/**
 * API for backend code to handout card based of number of player
 *
 * @param int players (This players refers to number of players)
 *
 * Success
 * @return
 *  {
 *      status: true,
 *      data: data,
 *  }
 *
 * Failed
 * @return
 *  {
 *      status: false,
 *      reason: 'Why it failed'
 *  }
 *
 * Steps
 * 1) Check players exist of null
 *      - Return Failed
 * 2) Check players is less or equal 0
 *      - Return Failed
 * 3) Check players more than regularity number
 *      - Return Failed
 * 4) Suffle deck and assign all deck until finish to every player
 * 5) Return Success
*/

if (!isset($_POST['players']) || $_POST['players']== "") {
    echo json_encode([
      'status' => false,
      'reason' => "Input value does not exist or value is invalid",
    ]);
    exit();
}

$players = (int) trim($_POST['players']);

if ($players <= 0) {
    echo json_encode([
      'status' => false,
      'reason' => "Any number less than 0 is an invalid value",
    ]);
    exit();
}

$shapes = ['S', 'H', 'D', 'C'];
$numbers = ['A', '2', '3', '4', '5', '6', '7', '8', '9', 'X', 'J', 'Q', 'K'];
$deck = [];

foreach ($shapes as $shape) {
    foreach ($numbers as $number) {
        $deck[] = $number . $shape;
    }
}

//  Due to different memory limitations in your PHP environment
$max_count = 100000;
if ($players > $max_count) {
    echo json_encode([
      'status' => false,
      'reason' => "Irregularity occurred",
    ]);
    exit();
}

shuffle($deck);
$hands = array_fill(0, $players, []);
$playerIndex = 0;

foreach ($deck as $card) {
    $hands[$playerIndex][] = $card;
    $playerIndex = ($playerIndex + 1) % $players;
}

echo json_encode([
    'status' => true,
    'data' => $hands,
]);
exit();
