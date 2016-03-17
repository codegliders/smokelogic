<?php

namespace App\Http\Controllers;

use App\Cigarette;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CigaretteRepository;
use Auth;
use DB;

class CigaretteController extends Controller {

    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $cigarettes;

    /**
     * Create a new controller instance.
     *
     * @param CigaretteRepository $tasks
     * @return void
     */
    public function __construct(CigaretteRepository $cigarettes) {
        $this->middleware('auth');
        $this->cigarettes = $cigarettes;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) {
        $user=  Auth::user();
        $count=  Cigarette::getTodayCigarettes();

           $weekCigarettes=Cigarette::getWeekCigarettes();
           $yesterdayCigarettes=  Cigarette::getYesterdayCigarettes();
        $monthCigarettes=Cigarette::getMonthCigarettes();
        $minutecigarettes=Cigarette::getCigarettesInMintesDuringDay();
       // $lastcigarettemin=  Cigarette::getCigarettesLastMinutes();
       // dd($lastcigarettemin);
        $cigarettes=DB::table('cigarettes')->where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
      
        return view('cigarettes.index', [
            //'cigarettes' => $this->cigarettes->forUser($request->user()),
            'cigarettes' => $cigarettes,
            'count'=>$count,
            'weekcigarettes'=>$weekCigarettes,
            'yesterdaycigarettes'=>$yesterdayCigarettes,
              'monthcigarettes'=>$monthCigarettes,
            'minutesbycigarettes'=>$minutecigarettes,
            
        ]);
    }

    /**
     * Create a new task.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'cigarette' => 'required',
             'date' => 'required',
             'time' => 'required',
        ]);
        $request->user()->cigarettes()->create([
            'cigarette' => $request->cigarette,
            'date' => $request->date,
            'time' => $request->time,
        ]);
        return redirect('/cig');
    }

    /**
     * Destroy the given task.
     *
     * @param Request $request
     * @param Cigarette $cigarette
     * @return Response
     */
    public function destroy($cig,Request $request, Cigarette $cigarette) {
       //$this->authorize('destroy', $cigarette);
     // dd($cig);

        $cigar=$cigarette->find($cig);
        $cigar->delete();
        //$cigarette->delete($cig);
        return redirect('/cig');
    }
    
      /**
     * Get Chart data for last two weeks.
     *
     * @param Request $request
     * @return Response
     */
    public function getBarChartDataLastTwoWeeks() {
        $data = Cigarette::getBarChartLastTwoWeeks();
        return($data);
    }
    
  
    
    public function getWeekCigarettes(){
        $data=  Cigarette::getWeekCigarettes();
        return $data;
    }

}
