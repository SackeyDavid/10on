<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\OneWayBookingProcess;
use App\ReturnBooking;
use Mail;


class SendCheckinReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendCheckinReminder:checkinreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify travelers of checkin time via sms or email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $onewaybookings = OneWayBookingProcess::where('checked_in', null)->orderBy('created_at', 'DESC')->get();
        $ow_trip_dates = array();

        foreach ($onewaybookings as $value) {
                //array_push($ow_dates_array, date('Ymd', strtotime(explode(" ", $value->created_at)[0])));

                $trip_date = explode(" ", $value->trip->departure_date)[1] . "-" . explode(" ", $value->trip->departure_date)[2] . "-" . explode(" ", $value->trip->departure_date)[3];
                $trip_date = strtotime($trip_date);
                //$trip_date+= 1209600; // add two weeks to get actual date

                $now = date('Ymd'); 
                
                $current_ow_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_ow_date;
                if ($diffDays < 1) {
                   array_push($ow_trip_dates, date('Ymd', $trip_date)); 
                }
        }



        $returnbookings = ReturnBooking::where('depart_checked_in', null)->orWhere('return_checked_in', null)->orderBy('created_at', 'DESC')->get();
        $rt_outbound_dates = array();

        $rt_inbound_dates = array();

        foreach ($returnbookings as $value) {
                $trip_date = explode(" ", $value->departing->departure_date)[1] . "-" . explode(" ", $value->departing->departure_date)[2] . "-" . explode(" ", $value->departing->departure_date)[3];
                
                $trip_date = strtotime($trip_date);

                // $trip_date+= 1209600; // add two weeks to get actual date
                // $test = date('Ymd', $trip_date);

                $now = date('Ymd'); 
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_outbound_dates, date('Ymd', $trip_date)); 
                }

                $trip_date = explode(" ", $value->returning->departure_date)[1] . "-" . explode(" ", $value->returning->departure_date)[2] . "-" . explode(" ", $value->returning->departure_date)[3];
                $trip_date = strtotime($trip_date);
                // $trip_date+= 1209600; // add two weeks to get actual date

                
                
                $current_rt_date = date('Ymd', $trip_date);
                $diffDays = $now - $current_rt_date;
                if ($diffDays < 1) {
                   array_push($rt_inbound_dates, date('Ymd', $trip_date)); 
                }
        }

        $combined_return_trip_dates = array_merge($rt_outbound_dates, $rt_inbound_dates);
        // merge both ow and rt futures trip dates
        $combined_trip_dates = array_merge($combined_return_trip_dates, $ow_trip_dates); 

        // avoid duplicates in future dates
        $combined_trip_dates = array_unique($combined_trip_dates);

        // sort both ow and rt future trip dates in ascencing(ie most recent) order
        usort($combined_trip_dates, function($a, $b) {
            return strtotime($a) - strtotime($b);
        });


        foreach ($combined_trip_dates as $unchecked_trip_date) {


            foreach ($onewaybookings as $ow) {
                $ow_trip_date = explode(" ", $ow->trip->departure_date)[1] . "-" . explode(" ", $ow->trip->departure_date)[2] . "-" . explode(" ", $ow->trip->departure_date)[3];

                $ow_trip_date = strtotime($ow_trip_date);
                //$ow_trip_date+= 1209600;

                if (date('Ymd', $ow_trip_date) != date('Ymd', strtotime($unchecked_trip_date))) {
                    continue;
                }
                else {
                    $now = Carbon::parse(date('Ymd'));
                    $departing_date = Carbon::parse($ow->trip->departure_date);

                    $days_left = $departing_date->diffInDays($now) . ' days';
                    if (explode(" ",$days_left)[0] <= 1) {
                        $days_left = $departing_date->diffInHours($now) . ' hours';
                        if (explode(" ", $days_left)[0] <= 1 ) {
                            $days_left = $departing_date->diffInMinutes($now) . ' mins';    
                            if (explode(" ", $days_left)[0] <= 1 ) {
                            $days_left = $departing_date->diffInSeconds($now) . ' seconds';    
                        
                            }
                        }
                    } 

                    if ($days_left == '12 hours' || $days_left == '6 hours' || $days_left == '2 hours' || $days_left == '30 mins' || $days_left == '15 mins') {
                        // send email reminder
                        $email = $name = $receiver = "";

                        if ($ow->user) {
                            $email = $ow->user->email;
                            $name = $ow->user->first_name;
                            $receiver = $ow->user;
                        }
                        else {
                            $email = $ow->passenger->email;
                            $name = $ow->passenger->first_name;
                            $receiver = $ow->passenger;
                        }

                        $data = array('email' => $email, 'days_left' => $days_left, 'name' => $name, 'from' => '10ondrives@gmail.com', 'from_name' => '10ondrives.com');

                        Mail::send(['text' => 'mail.trip_reminder'], ['receiver' => $receiver, 'days_left' => $days_left], function($message) use ($data)
                        {
                            $message->to($data['email'], $data['name'])->subject('Hello ' . $data['name'] . ', your bus takes off in ' . $data['days_left']);
                            $message->from($data['from'], $data['from_name']);
                        });

                        //send SMS reminder
                        $from = urlencode("Trip Reminder");
                        $to = urlencode('233'. ltrim($receiver->mobile_number, '0'));
                        $ClientId1 = urlencode('ahntkmmu');
                        $ClientSecret1 = urlencode('anxixrrt');
                        $content = urlencode('Hello '.$receiver->first_name . ' ' . $receiver->last_name . '! Your bus will be taking off in '. $days_left . '. You can check-in online at ' . route('bus.info') . '  when you are ready to depart or to stop receiving this reminder.');
                        $json = file_get_contents("https://{$ClientId1}:{$ClientSecret1}@api.hubtel.com/v1/messages/send?From={$from}&To={$to}&Content={$content}&ClientId={$ClientId1}ifrp&ClientSecret={$ClientSecret1}nml&RegisteredDelivery=true");
                        $obj = json_decode($json, true);

                        
                    }
                }

                

            }
            
        }
        

    }
}
