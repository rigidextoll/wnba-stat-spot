<?php

namespace App\Http\Controllers;

use App\Services\WnbaDataService;
use Illuminate\Http\Request;

class Main extends Controller
{
    private array $wnbaTeamData;
    private array $wnbaTeamScheduleData;
    private array $wnbaPbpData;

    private function loadAllData()
    {
        $wnbaDataService = new WnbaDataService();
        $wnba_team_data_path =$wnbaDataService->downloadTeamData();
        $wnba_team_schedule_data_path = $wnbaDataService->downloadTeamScheduleData();
        $wnba_pbp_data_path = $wnbaDataService->downloadPbpData();

        $this->wnbaTeamData = $wnbaDataService->parseTeamData($wnba_team_data_path);
        $this->wnbaTeamScheduleData = $wnbaDataService->parseTeamScheduleData($wnba_team_schedule_data_path);
        $this->wnbaPbpData = $wnbaDataService->parsePbpData($wnba_pbp_data_path);
    }

    private function saveAllData()
    {
        $wnbaDataService = new WnbaDataService();
        $wnbaDataService->saveBoxScoreData($this->wnbaPbpData);
        $wnbaDataService->saveTeamScheduleData($this->wnbaTeamScheduleData);
        $wnbaDataService->saveTeamData($this->wnbaTeamData);
    }

    public function main() {
        $this->loadAllData();
        $this->saveAllData();
        $data = $this->wnbaTeamData . $this->wnbaTeamScheduleData . $this->wnbaPbpData; // TODO: remove this after testing
        return view('main', compact('data'));
    }

}
