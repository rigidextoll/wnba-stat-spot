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
        // For now, just return the SPA view without loading data
        // Data loading can be triggered separately via API endpoints
        return view('app');
    }

    public function loadData() {
        // Separate endpoint for data loading
        $this->loadAllData();
        $this->saveAllData();

        return response()->json(['message' => 'Data loaded successfully']);
    }
}
