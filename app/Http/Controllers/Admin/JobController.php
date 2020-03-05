<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function index()
    {
        return response()->json(Job::all());
    }


    public function store(Request $request)
    {
        $job = new Job();
        $job->title = $request->title;
        $job->location = $request->location;
        $job->activities = $request->activities;
        $job->requirements = $request->requirements;
        $job->technologies = $request->technologies;
        $job->save();

        return response()->json([
            'success' => 'Vaga de trabalho criada com sucesso!',
            'data' => $job,
        ], 201);
    }


    public function show($id)
    {
        $job = Job::find($id);
        if(!$job){
            return response()->json(['error' => 'Vaga não encontrada!'], 404);
        }
        return response()->json($job);
    }


    public function update(Request $request, Job $job)
    {

        // $request->validated();

        $job->update($request->all());

        return response()->json([
            'success' => 'Vaga alterada com sucesso!',
            'data' => $job,
        ], 200);
    }



    public function destroy($id)
    {
        $job = job::find($id);
        if(!$job){
            return response()->json(['error' => 'Usuário não encontrado!'], 404);
        }
        $job->delete();

        return response()->json(['success' => 'Usuário removido com sucesso!'], 200);
    }
}
