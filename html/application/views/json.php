<?php
    if (is_array($json))
    {
        echo json_encode($json);
    }
    else
    {
        echo $json;
    }
?>