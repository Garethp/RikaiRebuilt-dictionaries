<?php

ini_set('memory_limit', '1G');

$dictionaries = [
    'english' => [
        'name' => 'Japanese To English Dictionary',
        'id' => 'e82ffa3b-1cd4-4749-b5bf-9a6f64e6890a',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'names' => [
        'name' => 'Japanese Names',
        'id' => '359fe507-7235-4040-8f7b-c5af90e9897d',
        'hasType' => false,
        'isNameDictionary' => true,
        'isKanjiDictionary' => false,
    ],
    'dutch' => [
        'name' => 'Japanese To Dutch Dictionary',
        'id' => 'a544e3ba-51cc-4574-aed5-54e195557e17',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'french' => [
        'name' => 'Japanese To French Dictionary',
        'id' => 'eb8e4ac0-9086-4710-b121-05f2acef5664',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'german' => [
        'name' => 'Japanese To German Dictionary',
        'id' => '1d7e1b66-8478-4a7d-8c00-60cb85af772e',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'hungarian' => [
        'name' => 'Japanese To Hungarian Dictionary',
        'id' => 'ef5f073d-a6a9-4a24-82b5-b9a900ee21af',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'russian' => [
        'name' => 'Japanese to Russian Dictionary',
        'id' => '62be5b14-353b-4a25-92d7-341da40fd380',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
    'thai' => [
        'name' => 'Japanese to Thai Dictionary',
        'id' => 'bef50e55-3d98-438f-801f-70137714be30',
        'hasType' => true,
        'isNameDictionary' => false,
        'isKanjiDictionary' => false,
    ],
];

function convertCSV($filename, $dictionary)
{
    $name = $dictionary['name'];
    $id = $dictionary['id'];

    $csv = file_get_contents("$filename.csv");
    $csv = explode("\n", $csv);

    $csv = array_map(function ($line) {
        if ($line === '') {
            return null;
        }

        $array = str_getcsv($line);

        if (!isset($array[2])) {
            $a = 1;
        }

        return ['kanji' => $array[0], 'kana' => $array[1], 'entry' => $array[2]];
    }, $csv);

    $json = [
        'name' => $name,
        'id' => $id,
        'hasType' => $dictionary['hasType'],
        'isNameDictionary' => $dictionary['isNameDictionary'],
        'isKanjiDictionary' => $dictionary['isKanjiDictionary'],
        'entries' => $csv,
    ];

    file_put_contents("$filename.json", json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Processed $filename.csv\r\n";
}

foreach ($dictionaries as $filename => $dictionary) {
    convertCSV($filename, $dictionary);
}

exit();
