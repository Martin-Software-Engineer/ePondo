<?php 
namespace App\Helpers;

class System{
    public static function GenerateFormattedId($prefix, $id){
        $ids = explode('.',strval(($id/1000)));

        return $prefix.'-'.(str_pad((int)$ids[0], 3, '0', STR_PAD_LEFT)).'-'.(str_pad((int)$ids[1] + 1, 3, '0', STR_PAD_LEFT));
    }

    public static function StatusTextValue($code, $hasBadge = false){
        $status = [];

        if($hasBadge){
            $status = [
                '1' => '<span class="badge " style="background-color:lightskyblue">Pending Request</span>', 
                '2' => '<span class="badge badge-primary">Accepted</span>',
                '3' => '<span class="badge badge-danger">Declined</span>', 
                '4' => '<span class="badge badge-info" style="background-color:limegreen">Ongoing</span>', 
                '5' => '<span class="badge badge-warning">Pending Payment</span>', 
                '6' => '<span class="badge badge-secondary" style="background-color:darkmagenta">Pending Rating & Feedback</span>', 
                '7' => '<span class="badge badge-success">Completed</span>',
                '8' => '<span class="badge badge-danger" style="background-color:red">Cancelled</span>'
            ];
        }else{
            $status = [
                '1' => 'Pending Request', 
                '2' => 'Accepted',
                '3' => 'Declined', 
                '4' => 'Ongoing', 
                '5' => 'Pending Payment', 
                '6' => 'Pending Rating & Feedback', 
                '7' => 'Completed',
                '8' => 'Cancelled'
            ];
        }

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
               return $service_price*0.006;
            break;
            case 'gold': 
                return $service_price*0.012;
            break;
            case 'platinum': 
                return $service_price*.02;
            break;
            default: 
            return 0;
        }
    }

    public static function get_avatar($str){
        $acronym = '';
        $word = '';
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }
}