<?php
$m = new MongoClient;
$db = $m->test;
$people = $db->people;
$people->drop();

$people->insert(array("name" => "Joe", "points" => 4));
$people->insert(array("name" => "Molly", "points" => 43));
$people->insert(array("name" => "Sally", "points" => 22));
$people->insert(array("name" => "Joe", "points" => 22));
$people->insert(array("name" => "Molly", "points" => 87));
$people->insert(array("name" => "Mollyyy", "points" => 87));
$ages = $people->aggregateCursor( [
        [ '$group' => [ '_id' => '$name', 'points' => [ '$sum' => '$points' ] ] ],
        [ '$sort' => [ 'points' => -1 ] ],
] );
var_dump($ages);
if (extraOpts === undefined) {
    extraOpts = {};
}

if (extraOpts.cursor === undefined){
    extraOpts.cursor = {batchSize: 1000};
}
var_dump(iterator_to_array($ages));

foreach ($ages as $person) {
    echo "{$person['_id']}: {$person['points']}\n";
}

?>