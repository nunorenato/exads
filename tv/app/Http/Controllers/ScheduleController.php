<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidDateException;
use App\ScheduleTime;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ScheduleController extends Controller
{
    /**
     * Gets the next showing from http request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNextSeriesRequest(Request $request){

        return $this->getNextSeries($request->query('date'), $request->query('series'));
    }

    /**
     * Gets the next showing
     *
     * @param string|null $dateTime
     * @param string|null $seriesName
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNextSeries(string $dateTime = null, string $seriesName = null){

        if($dateTime != null) {
            // parse the date into a timestamp
            try{
                $scheduleTime = ScheduleTime::fromString($dateTime);
            }
            catch(InvalidDateException $ide){
                return response()->json(['error' => $ide->getMessage()], 500);
            }
        }
        else
            $scheduleTime = ScheduleTime::fromTimestamp(time());

        $next = DB::table('tv_series_intervals')
            ->join('tv_series', 'id_tv_series', '=', 'tv_series.id')
            ->when($seriesName, function (Builder $query, string $seriesName) {
                $query->where('title', 'LIKE', $seriesName);
            })
            ->where('show_time', '>=', $scheduleTime->timeInSeconds)
            ->orderByRaw("if(week_day<{$scheduleTime->dayOfWeek},week_day+7,week_day)")->orderBy('show_time')
            ->select(['title', 'week_day', 'show_time'])
            ->first();

        if(!$next)
            return response()->json([]);

        $showDate = new ScheduleTime($next->week_day, $next->show_time, $scheduleTime->referenceTimestamp);
        return response()->json([
            'title' => $next->title,
            'show_date' => $showDate->toRealDate()
        ]);
    }

}
