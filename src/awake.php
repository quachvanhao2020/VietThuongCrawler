<?php
attach_event(DEBUG,function($e){
    $params = $e->getParams();
    echo json_encode($params);
});