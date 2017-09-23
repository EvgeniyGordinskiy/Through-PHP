<?php

// int levenshtein ( string $str1 , string $str2 )

// int levenshtein ( string $str1 , string $str2 , int $cost_ins , int $cost_rep , int $cost_del )

/*

The Levenshtein distance is defined as the minimal number of characters you have to replace, insert or delete to transform str1 into str2. The complexity of the algorithm is O(m*n), where n and m are the length of str1 and str2 (rather good when compared to similar_text(), which is O(max(n,m)**3), but still expensive).

In its simplest form the function will take only the two strings as parameter and will calculate just the number of insert, replace and delete operations needed to transform str1 into str2.

A second variant will take three additional parameters that define the cost of insert, replace and delete operations. This is more general and adaptive than variant one, but not as efficient.

*/

// input misspelled word
$input = 'carrrot';

// array of words to check against
$words1  = array('apple','pineapple','banana','orange',
                'radish','carrot','pea','bean','potato');

$words2  = array('apple','pineapple','banana','orange',
                'radish','pea','bean','potato');

// no shortest distance found, yet
$shortest = -1;

// loop through words to find the closest
function leva( $input $words) {

foreach ($words as $word) {

    // calculate the distance between the input word,
    // and the current word
    $lev = levenshtein($input, $word);

    // check for an exact match
    if ($lev == 0) {

        // closest word is this one (exact match)
        $closest = $word;
        $shortest = 0;

        // break out of the loop; we've found an exact match
        break;
    }

    // if this distance is less than the next found shortest
    // distance, OR if a next shortest word has not yet been found
    if ($lev <= $shortest || $shortest < 0) {
        // set the closest match, and shortest distance
        $closest  = $word;
        $shortest = $lev;
    }
}

echo "Input word: $input\n";
if ($shortest == 0) {
    return "Exact match found: $closest\n";
} else {
    return "Did you mean: $closest?\n";
}

	
}

leva($input, $words1); // Input word: carrot Did you mean: carrot?

leva($input, $words2); // Input word: carrot Did you mean: radish?