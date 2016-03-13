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
        $count = 0;
        $user = Auth::user();
        $today = date('Y-m-d');

        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->where('date', $today)->get();
        $i = 0;


        foreach ($cigarettes as $cig) {
            $i++;
        }
        $count = $i; //count($cigarettes);
        return $count;
    }

    public static function getWeekCigarettes() {
        $count = 0;
        $user = Auth::user();
        $today = date('Y-m-d', strtotime("-1 day"));
        $oneWeekAgo = date('Y-m-d', strtotime("-1 week"));
        $datePrevious = null;
        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->whereBetween('date', array( $oneWeekAgo,$today))->get();
        $days = 0;


        foreach ($cigarettes as $cig) {
            if($cig->date!==$datePrevious){
                $days++;
            }
            
            for ($i=1; $i<=7; $i++) {
                $day = date('Y-m-d', strtotime("-" . $i . " day"));
                if ($cig->date == $day) {
                    $count++;
                } 
                
            }
            $datePrevious=$cig->date;
        }
        $cigByDay=$count/$days;
      
        return round($cigByDay,0);
    }
    
    public static function getMonthCigarettes() {
        $count = 0;
        $user = Auth::user();
        $today = date('Y-m-d', strtotime("-1 day"));
        $oneMonthAgo = date('Y-m-d', strtotime("-1 month"));
        $datePrevious = null;
        $cigarettes = DB::table('cigarettes')->where('user_id', $user->id)->whereBetween('date', array( $oneMonthAgo,$today))->get();
        $days = 0;


        foreach ($cigarettes as $cig) {
            if($cig->date!==$datePrevious){
                $days++;
            }
            
            for ($i=1; $i<=30; $i++) {
                $day = date('Y-m-d', strtotime("-" . $i . " day"));
                if ($cig->date == $day) {
                    $count++;
                } 
                
            }
            $datePrevious=$cig->date;
        }
        $cigByDay=$count/$days;
      
        return round($cigByDay,0);
    }

}
