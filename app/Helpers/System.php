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
        $tier = 'no-star';
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

    public static function RewardsNextTier($points){
        $tier = 'Silver';
        if($points >= 100 && $points <= 499){
            $tier = 'Gold';
        }
        if($points >= 500 && $points <= 999){
            $tier = 'Platinum';
        }

        return $tier;
    }

    public static function RewardsProgress($points){
        $min = 0;
        $max = 100;
        $req = $max - $points;
        if($points >= 100 && $points <= 499){
            $min = 100;
            $max = 499;
            $req = $max-$points;
        }
        if($points >= 500 && $points <= 999){
            $min = 500;
            $max = 999;
            $req = $max-$points;
        }
        if($points >= 1000){
            $min = 1000;
            $max = -1;
            $req = $max-$points;
        }

        return (object)[
            'min' => $min,
            'max' => $max,
            'current' => $points,
            'req' => $req
        ];
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