<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Division;
use App\Models\Range;
use App\Models\Section;
use App\Models\Beat;
use App\Models\Forestblock;

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
    public function getForestblocks($divisionId)
    {
        return Forestblock::where('parent_id', $divisionId)
            ->where('active', 1)
            ->orderBy('id')
            ->get(['id', 'name_e']);
    }
    public function getCircleNameById($circleId)
    {
        // Fetch the circle record by its ID
        $circle = Circle::where('id', $circleId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        // Check if the circle exists and return its name or a suitable message
        if ($circle) {
            return response()->json(['id' => $circle->id, 'name_e' => $circle->name_e]);
        } else {
            return response()->json(['error' => 'Circle not found'], 404);
        }
    }
    public function getDivisionNameById($divisionId)
    {
        $division = Division::where('id', $divisionId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        if ($division) {
            return response()->json(['id' => $division->id, 'name_e' => $division->name_e]);
        } else {
            return response()->json(['error' => 'Division not found'], 404);
        }
    }

    public function getRangeNameById($rangeId)
    {
        $range = Range::where('id', $rangeId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        if ($range) {
            return response()->json(['id' => $range->id, 'name_e' => $range->name_e]);
        } else {
            return response()->json(['error' => 'Range not found'], 404);
        }
    }

    public function getSectionNameById($sectionId)
    {
        $section = Section::where('id', $sectionId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        if ($section) {
            return response()->json(['id' => $section->id, 'name_e' => $section->name_e]);
        } else {
            return response()->json(['error' => 'Section not found'], 404);
        }
    }

    public function getBeatNameById($beatId)
    {
        $beat = Beat::where('id', $beatId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        if ($beat) {
            return response()->json(['id' => $beat->id, 'name_e' => $beat->name_e]);
        } else {
            return response()->json(['error' => 'Beat not found'], 404);
        }
    }

    public function getForestblockNameById($forestblockId)
    {
        $forestblock = Forestblock::where('id', $forestblockId)
            ->where('active', 1)
            ->first(['id', 'name_e']);

        if ($forestblock) {
            return response()->json(['id' => $forestblock->id, 'name_e' => $forestblock->name_e]);
        } else {
            return response()->json(['error' => 'Forestblock not found'], 404);
        }
    }

}
