<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use DB;

//use Illuminate\Http\Request;

class Cigarette extends Model {/**
 * The attributes that are mass assignable.
 *
 * @var array
 */

    protected $fillable = ['cigarette', 'date', 'time'];

    /**
     * Get the user that owns the task.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function getBarChartLastTwoWeeks() {
        $user = Auth::user();
        $today = date("Y-m-d");
        $twoWeeksAgo = date('Y-m-d', strtotime("-2 week"));


        $mindate = DB::table('cigarettes')->where('user_id', $user->id)->min('date');


        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->whereBetween('date', array($twoWeeksAgo, $today))->get();

        $data = array();

        $i = 0;
        $cigmine = 0;
        $datePrevious = null;
        $user = Auth::user();

        foreach ($cigarettes as $cig) {

            if ($cig->date !== $datePrevious) {

                foreach ($cigarettes as $cig2) {

                    if ($cig2->date == $cig->date) {
                        $cigmine = $cigmine + 1;
                    } else {
                        // $cigmine = $cigmine;
                    }
                }

                $data[$i]['cigarettes'] = $cigmine;
                $data[$i]['date'] = $cig->date;
                $i++;
            }
            $cigmine = 0;
            $datePrevious = $cig->date;
        }


        return($data);
    }

    public static function getTodayCigarettes() {
       
        $user = Auth::user();
        $today = date('Y-m-d');

        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->where('date', $today)->get();
       
        $count = count($cigarettes);
        return $count;
    }

    public static function getYesterdayCigarettes() {
      
        $user = Auth::user();
        $yesterday= date('Y-m-d', strtotime("-1 day"));

        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->where('date', $yesterday)->get();
     
        $count =count($cigarettes);
        return $count;
    }

    public static function getWeekCigarettes() {
        $count = 0;
        $user = Auth::user();
        $today = date('Y-m-d', strtotime("-1 day"));
        $oneWeekAgo = date('Y-m-d', strtotime("-1 week"));
        $datePrevious = null;
        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->whereBetween('date', array($oneWeekAgo, $today))->get();
        $days = 0;


        foreach ($cigarettes as $cig) {
            if ($cig->date !== $datePrevious) {
                $days++;
            }

            for ($i = 1; $i <= 7; $i++) {
                $day = date('Y-m-d', strtotime("-" . $i . " day"));
                if ($cig->date == $day) {
                    $count++;
                }
            }
            $datePrevious = $cig->date;
        }
        $cigByDay = $count / $days;

        return round($cigByDay, 0);
    }

    public static function getMonthCigarettes() {
        $count = 0;
        $user = Auth::user();
        $today = date('Y-m-d', strtotime("-1 day"));
        $oneMonthAgo = date('Y-m-d', strtotime("-1 month"));
        $datePrevious = null;
        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->whereBetween('date', array($oneMonthAgo, $today))->get();
        $days = 0;


        foreach ($cigarettes as $cig) {
            if ($cig->date !== $datePrevious) {
                $days++;
            }

            for ($i = 1; $i <= 30; $i++) {
                $day = date('Y-m-d', strtotime("-" . $i . " day"));
                if ($cig->date == $day) {
                    $count++;
                }
            }
            $datePrevious = $cig->date;
        }
        $cigByDay = $count / $days;

        return round($cigByDay, 0);
    }

    
    public static function getCigarettesInMintesDuringDay(){
        
       $user = Auth::user();
       $now=date('G:i:s');
       $today=date('Y-m-d');
       $minutesofday=1440;
       $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->where('date',  $today)->get();
       $cigcount=count($cigarettes);
     
       $minutessincemidnight=(time() - strtotime("today"))/60;
       $rndminutessincemidnight=round($minutessincemidnight,0);
       if($cigcount>0){
       $minutesbycig=$rndminutessincemidnight/$cigcount;
       $minutesbycig=  round($minutesbycig);
       }else{$minutesbycig=0;}
        return $minutesbycig;
        
    }
    
    public static function getCigarettesLastMinutes(){
        
       $user = Auth::user();
       $now=date('G:i:s');
       $today=date('Y-m-d');
       $minutesofday=1440;
       $cigarette = DB::table('cigarettes')->where('user_id', $user->id)->where('date',  $today)->max('time');
       $cig=strtotime($cigarette);
       $nw=  date('G:i:s');
       $nw=strtotime($nw);
     //  dd($nw ." ". $cig);
       $diff=($cig - $nw )/60;
       
       //THIS DOES NOT WORK
      // dd($nw . "   " .$cig);
//       $diff=(strtotime($now)-strtotime($cigarette));
//       $diff=date('H:i',$diff);
//       $cigcount=count($cigarettes);
//     
//     

      // $diff=(time() -strtotime($cigarette) )/60;
      // $diff=round($diff,0);
//       $rndminutessincemidnight=round($minutessincemidnight,0);
//       if($cigcount>0){
//       $minutesbycig=$rndminutessincemidnight/$cigcount;
//       $minutesbycig=  round($minutesbycig);
//       }else{$minutesbycig=0;}
        return $diff;
        
    }
}
