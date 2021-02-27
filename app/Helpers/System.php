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
    
    public static function RewardsTier($points){
        $tier = '';
        if($points >= 100 && $points <= 499){
            $tier = 'silver';
        }
        if($points >= 500 && $points <= 999){
            $tier = 'gold';
        }
        if($points >= 1000){
            $tier = 'platinum';
        }

        return $tier;
    }

    public static function RewardsEarn($service_price, $tier){
        switch($tier){
            case 'silver':
               return $service_price*0.6;
            break;
            case 'gold': 
                return $service_price*1.2;
            break;
            case 'platinum': 
                return $service_price*2;
            break;
            default: 
            return 0;
        }
    }
}