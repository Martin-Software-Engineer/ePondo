<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reward;
class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = array(
            ['actions' => 'Creating Account', 'points' => 100, 'name' => 'create_account'],
            ['actions' => 'Editing Public Profile', 'points' => 25, 'name' => 'edit_public_profile'],
            ['actions' => 'Creating 1st Campaign', 'points' => 50, 'name' => 'creating_1st_campaign'],
            ['actions' => 'Receiving 1st Campaign Donation', 'points' => 25, 'name' => 'receiving_1st_campaign_donation'],
            ['actions' => 'Creating 1st Service', 'points' => 50, 'name' => 'creating_1st_service'],
            ['actions' => 'Receiving 1st Service Order Request', 'points' => 25, 'name' => 'receiving_1st_service_order_request'],
            ['actions' => 'Accepting 1st Service Order Request', 'points' => 50, 'name' => 'accepting_1st_service_order_request'],
            ['actions' => 'Submit 1st Service Order Delivered', 'points' => 50, 'name' => 'submit_1st_service_order_delivered'],
            ['actions' => 'Creating 1st Service Order Feedback', 'points' => 25, 'name' => 'creating_1st_service_order_feedback'],
            ['actions' => 'Receiving 1st Service Order Rating & Feedback', 'points' => 25, 'name' => 'receiving_1st_service_order_rf'],
            ['actions' => 'Creating a Campaign', 'points' => 100, 'name' => 'creating_campaign'],
            ['actions' => 'Receiving a Campaign Donation', 'points' => 10, 'name' => 'receiving_campaign_donation'],
            ['actions' => 'Creating a Service', 'points' => 100, 'name' => 'creating_service'],
            ['actions' => 'Receiving Service Order Request', 'points' => 20, 'name' => 'receiving_service_order_request'],
            ['actions' => 'Accepting Service Order Request', 'points' => 50, 'name' => 'accepting_service_order_request'],
            ['actions' => 'Submitting a Service Order Delivered', 'points' => 50, 'name' => 'submitting_service_order_delivered'],
            ['actions' => 'Creating a Service Order Feedback', 'points' => 10, 'name' => 'creating_service_order_feedback'],
            ['actions' => 'Receiving a Service Order Rating & Feedback', 'points' => 10, 'name' => 'receiving_service_order_rf'],
            ['actions' => 'Reaching Gold Tier', 'points' => 150, 'name' => 'reaching_gold_tier'],
            ['actions' => 'Reaching Platinum Tier', 'points' => 200, 'name' => 'reaching_platinum_tier']
        );

        foreach($rewards as $reward){
            Reward::create($reward);
        }
    }
}
