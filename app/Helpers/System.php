<?php 
namespace App\Helpers;

class System{
    public static function GenerateFormattedId($prefix, $id){
        $ids = explode('.',strval(($id/1000)));

        return $prefix.'-'.(str_pad((int)$ids[0], 3, '0', STR_PAD_LEFT)).'-'.(str_pad((int)$ids[1] + 1, 3, '0', STR_PAD_LEFT));
    }

    public static function StatusTextValue($code){
        $status = [
            '1' => 'Pending Request', 
            '2' => 'Accepted',
            '3' => 'Declined', 
            '4' => 'Ongoing', 
            '5' => 'Pending Payment', 
            '6' => 'Pending Rating & Feedback', 
            '7' => 'Completed'
        ];

        return $status[$code];
    }
}