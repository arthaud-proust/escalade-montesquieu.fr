<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute doit être accepté.',
    'active_url' => ':attribute n\'est pas une url valide',
    'after' => ':attribute doit être une date après :date.',
    'after_or_equal' => ':attribute doit être une date après ou égale à :date.',
    'alpha' => ':attribute ne doit contenir que des lettres.',
    'alpha_dash' => ':attribute ne doit contenir que des lettres, nombres, "-" et "_".',
    'alpha_num' => ':attribute ne doit contenir que des chiffres et des lettres.',
    'array' => ':attribute doit être un tableau.',
    'before' => ':attribute doit être une date avant :date.',
    'before_or_equal' => ':attribute doit être une date avant ou égale à :date.',
    'between' => [
        'numeric' => ':attribute doit être compris entre :min et :max.',
        'file' => ':attribute doit être compris entre :min et :max Ko.',
        'string' => ':attribute doit contenir entre :min et :max caractères.',
        'array' => ':attribute doit contenir entre :min et :max items.',
    ],
    'boolean' => ':attribute doit être vrai ou faux.',
    'confirmed' => 'Les champs ne correspondent pas.',
    'date' => ':attribute n\'est pas une date valide.',
    'date_equals' => ':attribute doit être une date après :date.',
    'date_format' => ':attribute ne correspond pas au format :format.',
    'different' => ':attribute et :other doivent être différent.',
    'digits' => ':attribute doit être un nombre de :digits chiffres.',
    'digits_between' => ':attribute doit être un nombre entre :min and :max chiffres.',
    'dimensions' => 'Les dimensions de :attribute sont invalides.',
    'distinct' => ':attribute a une valeur dupliquée.',
    'email' => ':attribute doit être une adresse email valide.',
    'ends_with' => ':attribute doit se terminer par une des valeurs suivantes: :values.',
    'exists' => ':attribute sélectionné est invalide.',
    'file' => ':attribute doit être un fichier.',
    'filled' => ':attribute ne peut pas être vide.',
    'gt' => [
        'numeric' => ':attribute doit être plus grand que :value.',
        'file' => ':attribute doit être plus grand que :value Ko.',
        'string' => ':attribute doit contenir plus de :value caractères.',
        'array' => ':attribute doit contenir plus de :value items.',
    ],
    'gte' => [
        'numeric' => ':attribute ne peut pas être plus petit que :value.',
        'file' => ':attribute ne peut pas être plus petit que :value Ko.',
        'string' => ':attribute ne peut pas contenir moins de :value caractères.',
        'array' => ':attribute ne peut pas avoir moins de :value items.',
    ],
    'image' => ':attribute doit être une image.',
    'in' => ':attribute sélectionné est invalide.',
    'in_array' => ':attribute entré n\existe pas dans :other.',
    'integer' => ':attribute doit être un entier.',
    'ip' => ':attribute doit être une adresse IP valide.',
    'ipv4' => ':attribute doit être une adresse IPv4 valide.',
    'ipv6' => ':attribute doit être une adresse IPv6 valide.',
    'json' => ':attribute doit être au format JSON.',
    'lt' => [
        'numeric' => ':attribute doit être plus petit que :value.',
        'file' => ':attribute doit être plus petit que :value Ko.',
        'string' => ':attribute doit contenir moins de :value caractères.',
        'array' => ':attribute doit contenir moins de :value items.',
    ],
    'lte' => [
        'numeric' => ':attribute ne peut pas être plus grand que :value.',
        'file' => ':attribute ne peut pas être plus grand que :value Ko.',
        'string' => ':attribute ne peut pas contenir plus de :value caractères.',
        'array' => ':attribute ne peut pas avoir plus de :value items.',
    ],
    'max' => [
        'numeric' => ':attribute ne peut pas être plus grand que :value.',
        'file' => ':attribute ne peut pas être plus grand que :value Ko.',
        'string' => ':attribute ne peut pas contenir plus de :value caractères.',
        'array' => ':attribute ne peut pas avoir plus de :value items.',
    ],
    'mimes' => ':attribute doit être un fichier de type: :values.',
    'mimetypes' => ':attribute doit être un fichier de type: :values.',
    'min' => [
        'numeric' => ':attribute ne peut pas être plus petit que :value.',
        'file' => ':attribute ne peut pas être plus petit que :value Ko.',
        'string' => ':attribute ne peut pas contenir moins de :value caractères.',
        'array' => ':attribute ne peut pas avoir moins de :value items.',
    ],
    'not_in' => ':attribute sélectionné est invalide.',
    'not_regex' => 'Le format de :attribute est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => ':attribute doit être présent.',
    'regex' => 'Le format de :attribute est invalide.',
    'required' => ':attribute est requis.',
    'required_if' => ':attribute est requis quand :other is :value.',
    'required_unless' => ':attribute est requis jusqu\'à qu\'il y ai :other dans :values.',
    'required_with' => ':attribute est requis quand :values est présent.',
    'required_with_all' => ':attribute est requis quand :values sont présent.',
    'required_without' => ':attribute est requis quand :values n\'est pas présent.',
    'required_without_all' => ':attribute est requis quand aucun de :values n\'est présent.',
    'same' => ':attribute et :other doivent être identiques.',
    'size' => [
        'numeric' => ':attribute doit être :size.',
        'file' => ':attribute doit être :size Ko.',
        'string' => ':attribute doit contenir :size caractère(s).',
        'array' => ':attribute doit contenir :size item(s).',
    ],
    'starts_with' => ':attribute doit commencer avec un de ces valeurs: :values.',
    'string' => ':attribute doit être un texte.',
    'timezone' => ':attribute doit être une zone valide.',
    'unique' => ':attribute est déjà pris.',
    'uploaded' => ':attribute n\'a pas pu être envoyé.',
    'url' => 'Le format de :attribute est invalide.',
    'uuid' => ':attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
