<?php
function record_offset_paginate(int $limit=20, int $page_number = 1)
{
    if($page_number===1) {
        return 0;
    } else if($page_number===2) {
        return $limit;
    }
    return ($page_number-1)*$limit;
}
