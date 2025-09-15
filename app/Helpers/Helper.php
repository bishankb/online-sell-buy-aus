<?php

function pagination($data, $loop) {
    return ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1;
}

function reversePagination($data, $loop) {
    return $data->total() + 1 - (($data->currentpage() - 1) * $data->perpage() + $loop->index + 1);
}

?>