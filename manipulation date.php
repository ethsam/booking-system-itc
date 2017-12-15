<?php

    function dateFr($date){
    return strftime('%d-%m-%Y',strtotime($date));
    }

    echo dateFr('20171215082644'); //Affiche

?>