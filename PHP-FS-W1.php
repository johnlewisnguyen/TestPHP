<?php

/**
 * Check if the parameters are array
 * 
 * @param @arr1 is parameter 1
 * @param @arr2 is parameter 2
 * @param @arr3 is parameter 3
 * @return true if all params are array
 * @throws LogicException if there is at least one param is not array
 */
function paramIsArray($arr1, $arr2, $arr3)
{   
    $paramContainer = array($arr1, $arr2, $arr3);   //Contain all the params to check their types
    $invalidIndexMessage = '';                      //Returned Message of invalid param(s)
    $hasInvalid = 0;                               //0 if there is no invalid param otherwise 1

    foreach ($paramContainer as $index => $type) {
        if ((is_array($type) == 0) and (empty($invalidIndexMessage))) {         //Adding the first invalid index to the message
            $invalidIndexMessage = $invalidIndexMessage . $index+1;
            $hasInvalid = 1;
        } elseif ((is_array($type) == 0) and (!empty($invalidIndexMessage))) {  //Adding the following invalid index(s) to the message
            $invalidIndexMessage = $invalidIndexMessage . ", " . $index+1;
            $hasInvalid = 1;
        }
    }

    if ($hasInvalid == 1) {    //Throw Exception if there is an invalid param
        throw new Exception($invalidIndexMessage);
    }

    return true;
}

try {
    //Declare variables
    $a = array(2, 1, 3);
    $b = array(3, 1);
    $c = array(1, 3);

    //Check if they are Array, if not throw Exception
    paramIsArray($a, $b, $c);
    
    //Run below if they are valid inputs
    /**
     * Searching for Number 1 in the First Array
     * @param @arr1 is the first array
     * @return String "Found" or "Not Found"
     */
    function findOneInFirstArray($arr1) {
        echo "Exercise 1: </br>";
        $finder = array_search(1, $arr1);   
        if ($finder !== false) {
            echo "Found </br>";
        } else {
            echo "Not Found </br>";
        }
    }

    /**
     * Merging Array 2 and 3 then remove duplicate elements
     * @param @arr2 is the 2nd array
     * @param @arr3 is the 3rd array
     * @return Array $result merged array (*)
     */
    function mergeArray($arr2, $arr3) {
        $result = array_merge($arr2, $arr3);
        $result = array_unique($result);
        return $result;
    }

    /**
     * Check if a Value that Sum of its Digits is Divisible for 2
     * @param @num is the input number (value)
     * @return Boolean True if divisible, otherwise False
     */
    function sumCanDiv2Value($num) {
        $digitSum = 0;
        do {
            $digitSum += $num % 10; 
        } while ($num = $num/10); //Sequentially div 10 to split the last digit of the number then add it to sum
        if ($digitSum % 2 == 0) {
            return true;
        } else return false;
    }

    //Execute exercise 1:
    findOneInFirstArray($a);

    //Execute exercise 2:
    echo "Exercise 2: </br>";
    $mergedArray = mergeArray($b, $c);
    $resultAsString = implode(', ', $mergedArray); //convert Merged Array (*) to String
    echo($resultAsString . '</br>');

    //Execute exercise 3:
    echo "Exercise 3: </br>";
    $divisibleFor2 = array_filter($mergedArray, function($value) {
        return sumCanDiv2Value($value);      //Return Filtered Array of 2 Divisibles
    });
    $divisibleFor2 = implode(', ', $divisibleFor2); //convert Filtered Array (*) to String
    echo($divisibleFor2 . "</br>");

    //Execute exercise 4:
    echo "Exercise 4: </br>";
    $intersectAandMerged = array_intersect($a, $mergedArray); //Array of values that A and (*) have in common
    sort($intersectAandMerged);
    $intersectAandMerged = implode(', ', $intersectAandMerged);
    echo($intersectAandMerged . "</br>");

    //Excute exercise 5:
    echo "Exercise 5: </br>";
    $result = array();
    foreach ($a as $key => $value) {
        if (!in_array($key, $mergedArray)) {
            $result[] = $value; 
        }
    }
    sort($result);
    $result = array_reverse($result);
    $result = implode(', ', $result);
    echo($result);
}

catch(Exception $e) {
    echo 'Invalid parameter ' .$e->getMessage();
}
?>


