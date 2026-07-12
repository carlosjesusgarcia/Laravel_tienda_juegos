<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other sea :value.',
    'active_url' => 'El campo :attribute debe contener una URL válida.',
    'after' => 'El campo :attribute debe contener una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe contener una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_dash' => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y números.',
    'any_of' => 'El campo :attribute no es válido.',
    'array' => 'El campo :attribute debe ser un arreglo.',
    'ascii' => 'El campo :attribute solo debe contener caracteres alfanuméricos y símbolos de un byte.',
    'before' => 'El campo :attribute debe contener una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe contener una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'El campo :attribute debe contener entre :min y :max elementos.',
        'file' => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
        'numeric' => 'El campo :attribute debe tener un valor entre :min y :max.',
        'string' => 'El campo :attribute debe contener entre :min y :max caracteres.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'can' => 'El campo :attribute contiene un valor no autorizado.',
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'contains' => 'Al campo :attribute le falta un valor obligatorio.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El campo :attribute debe contener una fecha válida.',
    'date_equals' => 'El campo :attribute debe contener una fecha igual a :date.',
    'date_format' => 'El campo :attribute debe respetar el formato :format.',
    'decimal' => 'El campo :attribute debe tener :decimal posiciones decimales.',
    'declined' => 'El campo :attribute debe ser rechazado.',
    'declined_if' => 'El campo :attribute debe ser rechazado cuando :other sea :value.',
    'different' => 'Los campos :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute contiene una imagen con dimensiones no válidas.',
    'distinct' => 'El campo :attribute contiene un valor duplicado.',
    'doesnt_contain' => 'El campo :attribute no debe contener ninguno de los siguientes valores: :values.',
    'doesnt_end_with' => 'El campo :attribute no debe terminar con ninguno de los siguientes valores: :values.',
    'doesnt_start_with' => 'El campo :attribute no debe comenzar con ninguno de los siguientes valores: :values.',
    'email' => 'El campo :attribute debe contener una dirección de correo electrónico válida.',
    'encoding' => 'El campo :attribute debe estar codificado como :encoding.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes valores: :values.',
    'enum' => 'El valor seleccionado para :attribute no es válido.',
    'exists' => 'El valor seleccionado para :attribute no es válido.',
    'extensions' => 'El campo :attribute debe tener una de las siguientes extensiones: :values.',
    'file' => 'El campo :attribute debe contener un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El campo :attribute debe contener más de :value elementos.',
        'file' => 'El archivo :attribute debe pesar más de :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'string' => 'El campo :attribute debe contener más de :value caracteres.',
    ],
    'gte' => [
        'array' => 'El campo :attribute debe contener :value elementos o más.',
        'file' => 'El archivo :attribute debe pesar :value kilobytes o más.',
        'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
        'string' => 'El campo :attribute debe contener :value caracteres o más.',
    ],
    'hex_color' => 'El campo :attribute debe contener un color hexadecimal válido.',
    'image' => 'El campo :attribute debe contener una imagen.',
    'in' => 'El valor seleccionado para :attribute no es válido.',
    'in_array' => 'El campo :attribute debe existir en :other.',
    'in_array_keys' => 'El campo :attribute debe contener al menos una de las siguientes claves: :values.',
    'integer' => 'El campo :attribute debe contener un número entero.',
    'ip' => 'El campo :attribute debe contener una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe contener una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe contener una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe contener una cadena JSON válida.',
    'list' => 'El campo :attribute debe ser una lista.',
    'lowercase' => 'El campo :attribute debe estar escrito en minúsculas.',
    'lt' => [
        'array' => 'El campo :attribute debe contener menos de :value elementos.',
        'file' => 'El archivo :attribute debe pesar menos de :value kilobytes.',
        'numeric' => 'El campo :attribute debe ser menor que :value.',
        'string' => 'El campo :attribute debe contener menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'El campo :attribute no debe contener más de :value elementos.',
        'file' => 'El archivo :attribute debe pesar :value kilobytes o menos.',
        'numeric' => 'El campo :attribute debe ser menor o igual que :value.',
        'string' => 'El campo :attribute debe contener :value caracteres o menos.',
    ],
    'mac_address' => 'El campo :attribute debe contener una dirección MAC válida.',
    'max' => [
        'array' => 'El campo :attribute no debe contener más de :max elementos.',
        'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe contener más de :max caracteres.',
    ],
    'max_digits' => 'El campo :attribute no debe tener más de :max dígitos.',
    'mimes' => 'El campo :attribute debe contener un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe contener un archivo de tipo: :values.',
    'min' => [
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
        'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
    ],
    'min_digits' => 'El campo :attribute debe tener al menos :min dígitos.',
    'missing' => 'El campo :attribute no debe estar presente.',
    'missing_if' => 'El campo :attribute no debe estar presente cuando :other sea :value.',
    'missing_unless' => 'El campo :attribute no debe estar presente a menos que :other sea :value.',
    'missing_with' => 'El campo :attribute no debe estar presente cuando :values esté presente.',
    'missing_with_all' => 'El campo :attribute no debe estar presente cuando :values estén presentes.',
    'multiple_of' => 'El campo :attribute debe ser múltiplo de :value.',
    'not_in' => 'El valor seleccionado para :attribute no es válido.',
    'not_regex' => 'El formato del campo :attribute no es válido.',
    'numeric' => 'El campo :attribute debe contener un número.',
    'password' => [
        'letters' => 'El campo :attribute debe contener al menos una letra.',
        'mixed' => 'El campo :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'numbers' => 'El campo :attribute debe contener al menos un número.',
        'symbols' => 'El campo :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El valor de :attribute apareció en una filtración de datos. Elegí otro valor.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'present_if' => 'El campo :attribute debe estar presente cuando :other sea :value.',
    'present_unless' => 'El campo :attribute debe estar presente a menos que :other sea :value.',
    'present_with' => 'El campo :attribute debe estar presente cuando :values esté presente.',
    'present_with_all' => 'El campo :attribute debe estar presente cuando :values estén presentes.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other sea :value.',
    'prohibited_if_accepted' => 'El campo :attribute está prohibido cuando :other sea aceptado.',
    'prohibited_if_declined' => 'El campo :attribute está prohibido cuando :other sea rechazado.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other se encuentre en :values.',
    'prohibits' => 'El campo :attribute impide que :other esté presente.',
    'regex' => 'El formato del campo :attribute no es válido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other sea :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other sea aceptado.',
    'required_if_declined' => 'El campo :attribute es obligatorio cuando :other sea rechazado.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other se encuentre en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values esté presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values estén presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no esté presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los valores :values esté presente.',
    'same' => 'El campo :attribute debe coincidir con :other.',
    'size' => [
        'array' => 'El campo :attribute debe contener :size elementos.',
        'file' => 'El archivo :attribute debe pesar :size kilobytes.',
        'numeric' => 'El campo :attribute debe ser :size.',
        'string' => 'El campo :attribute debe contener :size caracteres.',
    ],
    'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values.',
    'string' => 'El campo :attribute debe contener una cadena de texto.',
    'timezone' => 'El campo :attribute debe contener una zona horaria válida.',
    'unique' => 'El valor ingresado en el campo :attribute ya está registrado.',
    'uploaded' => 'No se pudo subir el archivo del campo :attribute.',
    'uppercase' => 'El campo :attribute debe estar escrito en mayúsculas.',
    'url' => 'El campo :attribute debe contener una URL válida.',
    'ulid' => 'El campo :attribute debe contener un ULID válido.',
    'uuid' => 'El campo :attribute debe contener un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name' => [
            'required' => 'El nombre de usuario es obligatorio.',
            'min' => 'El nombre debe tener al menos :min caracteres.',
        ],
        'email' => [
            'required' => 'El correo electrónico es obligatorio.',
            'email' => 'Ingresá un correo electrónico válido.',
            'unique' => 'Ese correo electrónico ya está registrado.',
        ],
        'password' => [
            'required' => 'La contraseña es obligatoria.',
            'min' => 'La contraseña debe tener al menos :min caracteres.',
            'confirmed' => 'Las contraseñas no coinciden.',
        ],
        'titulo' => [
            'required' => 'El título debe tener un valor.',
            'min' => 'El título debe tener al menos :min caracteres.',
        ],
        'precio' => [
            'required' => 'El precio debe tener un valor.',
            'numeric' => 'El precio debe ser un valor numérico.',
        ],
        'fecha_lanzamiento' => [
            'required' => 'La fecha de lanzamiento debe tener un valor.',
        ],
        'rating_fk' => [
            'required' => 'Hay que elegir una clasificación para el juego.',
            'exists' => 'La clasificación elegida no existe.',
        ],
        'generos' => [
            'required' => 'Hay que elegir al menos un género para el juego.',
        ],
        'generos.*' => [
            'exists' => 'Uno de los géneros elegidos no existe.',
        ],
        'sinopsis' => [
            'required' => 'La sinopsis debe tener un valor.',
        ],
        'portada' => [
            'file' => 'La portada debe ser un archivo.',
            'mimes' => 'La portada debe ser una imagen JPG, JPEG, PNG o WEBP.',
            'max' => 'La portada no puede pesar más de 2 MB.',
        ],
        'contenido' => [
            'required' => 'El contenido de la entrada no puede estar vacío.',
        ],
        'imagen' => [
            'image' => 'El archivo debe ser una imagen.',
            'mimes' => 'La imagen debe ser de tipo JPG, JPEG, PNG o WEBP.',
            'max' => 'La imagen no debe superar los 2 MB.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'nombre de usuario',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'titulo' => 'título',
        'precio' => 'precio',
        'fecha_lanzamiento' => 'fecha de lanzamiento',
        'rating_fk' => 'clasificación',
        'generos' => 'géneros',
        'generos.*' => 'género seleccionado',
        'sinopsis' => 'sinopsis',
        'portada' => 'portada',
        'contenido' => 'contenido',
        'imagen' => 'imagen',
    ],

];