<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Division;
use App\Models\Range;
use App\Models\Section;
use App\Models\Beat;

class MasterController extends Controller
{
    public function getCircles()
    {
        return Circle::where('active', 1)
            ->where('name_e', '!=', 'EVC')
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }

    public function getDivisions($circleId)
    {
        return Division::where('parent_id', $circleId)
            ->where('active', 1)
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }

    public function getRanges($divisionId)
    {
        return Range::where('parent_id', $divisionId)
            ->where('active', 1)
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }

    public function getSections($rangeId)
    {
        return Section::where('parent_id', $rangeId)
            ->where('active', 1)
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }

    public function getBeats($sectionId)
    {
        return Beat::where('parent_id', $sectionId)
            ->where('active', 1)
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }
}
