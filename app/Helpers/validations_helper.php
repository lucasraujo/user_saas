<?php

function passwordValidationRule()
{
    return [
        'label' => 'Password',
        'rules' => [
            'min_length[8]',
            'max_length[72]',
            'regex_match[/[A-Z]/]',
            'regex_match[/[a-z]/]',
            'regex_match[/[0-9]/]',
            'regex_match[/[\W]/]',
        ],
        'errors' => [
            'min_length' => 'The {field} must be at least 8 characters.',
            'max_length' => 'The {field} cannot exceed 72 characters.',
            'regex_match' => 'The {field} must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]
    ];
}