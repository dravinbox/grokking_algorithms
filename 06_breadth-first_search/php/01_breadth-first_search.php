<?php

function person_is_seller($name){
    return  substr($name,-1)== 'm';
}
$graph=array();
$graph['you']=array("alice", "bob", "claire");
$graph["bob"] = array("anuj", "peggy");
$graph["alice"] = array("peggy");
$graph["claire"] = array("thom", "jonny");
$graph["anuj"] = array();
$graph["peggy"] = array();
$graph["thom"] = array();
$graph["jonny"] = array();
function push_queue(&$search_queue,$neighbor){
    foreach ($neighbor as $v) {
        array_push($search_queue,$v);
    }
}

function search($name){
    global $graph;
    $search_queue=array();
    push_queue($search_queue,$graph[$name]);
    $searched=array();
    while (!empty($search_queue)) {
        $person=array_shift($search_queue);
        if(!in_array($person,$searched)){
            if(person_is_seller($person)){
                print($person." is a mango seller");
                return true;
            }else{
                push_queue($search_queue,$graph[$person]);
                array_push($searched,$person);
            }

        }
    }

}
search('you');