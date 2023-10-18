<?php
function showPriority($priority)
{
    $stats = [
        "low" => "<span class='badge bg-info'>Low</span>",
        "normal" => "<span class='badge bg-warning'>Normal</span>",
        "high" => "<span class='badge bg-danger'>High</span>",
    ];
    return $stats[$priority];
}
