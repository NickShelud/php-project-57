<?php

return [
    'required' => 'Это обязательное поле',
    'unique' => ':attribute с таким именем уже существует',
    'min' => [
        'string' => ':attribute должен иметь длину не менее :min символов.',
    ],
    'confirmed' => 'Пароль и подтверждение не совпадают',
    'attributes' => [
        'password' => 'Пароль',
        'status' => 'Статус',
        'label' => 'Метка',
    ],

];
