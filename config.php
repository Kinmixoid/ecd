<?php

    return [
        'input' => [
            // list of supported formats and declare the parser class
            'formats' => [
                'csv'=> [
                    'parser' => 'Parsers\CsvParser',

                    // headers to map to the properties of each model
                    'header-maps'=>[
                        'Models\Product'=>[
                            'brand_name'=>'make',
                            'model_name'=>'model',
                            'colour_name'=>'colour',
                            'condition_name'=>'condition',
                            'grade_name'=>'grade',
                            'network_name'=>'network',
                            'gb_spec_name'=>'capacity',
                        ]
                    ]
                ],
            ],

            //location of the input files
            'location'=>'data',

            //map file headers to the model properties
            //for xml or json files we could use xpath/jsonpath or dot notation

        ],

        'output' => [
            //location of the output files
            'location'=>'data',

            //list model properties to summarize output data by
            'group_by'=>[
                'make',
                'model',
                'colour',
                'condition',
                'grade',
                'network',
                'capacity'
            ]
        ],
    ];
