<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

class TranscriptionController extends Controller
{
    public function create()
    {
        return view('transcription.create', []);
    }

    public function store(Request $request)
    {
        $radio     = $request->radio;
        $ext       = $radio->getClientOriginalExtension();
        $audioData = file_get_contents($radio);
        Storage::disk('local')->put('radio.' . $ext, $audioData);
        $response = OpenAI::audio()->transcribe([
            'file'            => Storage::disk('local')->readStream('radio.' . $ext),
            'response_format' => 'text',
            'model'           => 'whisper-1',
        ]);
        $contentInPut = $response->text;
        $userMessages = [
            [
                'role'    => 'user',
                'content' => $contentInPut
            ]
        ];
        $response = OpenAI::chat()->create([
            'model'    => 'gpt-4o',
            'messages' => $userMessages
        ]);
        $choices       = $response->choices;
        $titleResponse = end($choices);
        $contentOutPut = $titleResponse->message->content;

        return view('transcription.create', [
            'content'      => $contentOutPut,
            'contentInPut' => $contentInPut
        ]);
    }
}
