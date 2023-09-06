<?php
function truncate(string $text, int $length = 20): string {
    if (strlen($text) <= $length) {
        return $text;
    }
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, " "));
    $text .= "...";
    return $text;
}

function company_info()
{
    return \App\Models\Setting::first();
}

function projects()
{
    return \App\Models\Project::all();
}
 function generateInitials(string $name) : string
{
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        return mb_strtoupper(
            mb_substr($words[0], 0, 1, 'UTF-8') .
            mb_substr(end($words), 0, 1, 'UTF-8'),
            'UTF-8');
    }
    return makeInitialsFromSingleWord($name);
}
 function makeInitialsFromSingleWord(string $name) : string
{
    preg_match_all('#([A-Z]+)#', $name, $capitals);
    if (count($capitals[1]) >= 2) {
        return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
    }
    return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
}
function resolveOrderStatus($status)
{
    return \App\Enums\OrderStatus::tryFrom($status)->label();
}
function resolveOrderStatusColor($status)
{
    return \App\Enums\OrderStatus::tryFrom($status)->color();
}
function resolvePaymentStatus($status)
{
    return \App\Enums\PaymentStatus::tryFrom($status)->label();
}
function resolvePaymentStatusColor($status)
{
    return \App\Enums\PaymentStatus::tryFrom($status)->color();
}
