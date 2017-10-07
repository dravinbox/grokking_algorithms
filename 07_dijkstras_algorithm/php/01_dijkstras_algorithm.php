<?php

$graph=array(
    'start'=>array(
        'a'=>6,
        'b'=>2,
    ),
    'a'=>array(
        'fin'=>1
    ),
    'b'=>array(
        'a'=>3,
        'fin'=>5
    ),
    'fin'=>null
);

$parents=array(
    'a'=>'start',
    'b'=>'start',
    'fin'=>null
);

$costs=array(
    'a'=>6,
    'b'=>2,
    'fin'=>NAN
);

$processed=array();

function find_lowest_cost_node(){
    global $costs;
    global $processed;
    $mix=0;
    $node=null;
    $f=false;
    foreach ($costs as $key => $value) {
        if(!is_nan($value)&&!in_array($key,$processed) ){
            if(!$f){
                $node=$key;
                $mix=$value;
                $f=true;
            }
            if($value<$mix){
                $node=$key;
                $mix=$value;

            }
        }

    }

    return $node;

}
//  $node=find_lowest_cost_node();
//  echo $node;


function search(){
    global $costs;
    global $graph;
    global $parents;
    global $processed;
    $node=find_lowest_cost_node();
    while($node!=null){
        $cost=$costs[$node];//2
        $neighbors=$graph[$node];//a=>3,fin=>5
        if(!empty($neighbors)){
            foreach ($neighbors as $key => $value) {
                $new_cost=$cost+$value;
                if($costs[$key]>$new_cost||is_nan($costs[$key])){
                    $costs[$key]=$new_cost;
                    $parents[$key]=$node;
                }
            }

        }
        array_push($processed,$node);
        $node=find_lowest_cost_node();

     }
}
search();
var_dump($costs);
//var_dump($parents);