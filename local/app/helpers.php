<?php

function trimCreatedAt($created_at){

    if ( time()-strtotime($created_at) < 60 ){
        return (time()-strtotime($created_at)).'s ago';
    }
    elseif ( time()-strtotime($created_at) >= 60 && time()-strtotime($created_at) < 3600 ) {
        return round( (time()-strtotime($created_at))/60 ).'m ago';
    }
    elseif ( time()-strtotime($created_at) >= 3600 && time()-strtotime($created_at) < 86400 ){
        return round( (time()-strtotime($created_at))/3600 ).'h ago';
    }
    elseif ( time()-strtotime($created_at) >= 86400 && time()-strtotime($created_at) < 604800 ){
        return round( (time()-strtotime($created_at))/86400 ).'d ago';
    }
    elseif ( time()-strtotime($created_at) >= 604800 && time()-strtotime($created_at) < 2419200 ){
        return round( (time()-strtotime($created_at))/604800 ).'w ago';
    }
    elseif ( time()-strtotime($created_at) >= 2419200 && time()-strtotime($created_at) < 31536000 ){
        return round( (time()-strtotime($created_at))/2419200 ).'y ago';
    }
    
}

function roundDistance($distance){
    $distance = round($distance);

    if ( $distance < 1 ){
        return '< 1 mile';
    }else {
        return $distance.' miles';
    }
}

function createDataURL($imgPath){
    // Read image path, convert to base64 encoding
    $imageData = base64_encode(file_get_contents($imgPath));
    //$imageData = base64_encode($imgPath);

    // Format the image SRC:  data:{mime};base64,{data};
    $src = 'data: image/jpeg;base64,'.$imageData;

    return $src;
}