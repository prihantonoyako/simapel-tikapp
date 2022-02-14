<?php
function pagination_record_number($currentPage, $perPage)
    {
        if (is_null($currentPage)) {
            $index_number = 1;
        }
        else if($currentPage==1) {
            $index_number = 1;
        } else {
            $index_number = 1 + ($perPage * ($currentPage - 1));
        }
        return $index_number; 
}