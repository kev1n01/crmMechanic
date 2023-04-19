<?php

namespace App\Traits;

trait WithCountries
{
    const DEPARTMENTS = [
        [
            'name' => 'Amazonas'
        ],
        [
            'name' => 'Ancash'
        ],
        [
            'name' => 'Apurimac'
        ],
        [
            'name' => 'Arequipa'
        ],
        [
            'name' => 'Ayacucho'
        ],
        [
            'name' => 'Cajamarca'
        ],
        [
            'name' => 'Callao'
        ],
        [
            'name' => 'Cusco'
        ],
        [
            'name' => 'Huancavelica'
        ],
        [
            'name' => 'Huanuco'
        ],
        [
            'name' => 'Ica'
        ],
        [
            'name' => 'Junin'
        ],
        [
            'name' => 'La Libertad'
        ],
        [
            'name' => 'Lambayeque'
        ],
        [
            'name' => 'Lima'
        ],
        [
            'name' => 'Loreto'
        ],
        [
            'name' => 'Madre de Dios'
        ],
        [
            'name' => 'Moquegua'
        ],
        [
            'name' => 'Pasco'
        ],
        [
            'name' => 'Piura'
        ],
        [
            'name' => 'Puno'
        ],
        [
            'name' => 'San Martin'
        ],
        [
            'name' => 'Tacna'
        ],
        [
            'name' => 'Tumbes'
        ],
        [
            'name' => 'Ucayali'
        ]
    ];

    const PROVINCES = [
        [
            'name' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Condorcanqui',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Asuncion',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Carlos Fermin Fitzcarrald',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Casma',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pomabamba',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huanca Sancos',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cajabamba',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Hualgayoc',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Pablo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Huacaybamba',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pachitea',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Junin',
            'department' => 'Junin'
        ],
        [
            'name' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chepen',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Julcan',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Gran Chimu',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Viru',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Mariscal Ramon Castilla',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Putumayo',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Tambopata',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Manu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Tahuamanu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Ilo',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Moho',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Jorge Basadre',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Tumbes',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Zarumilla',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Coronel Portillo',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Padre Abad',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Purus',
            'department' => 'Ucayali'
        ]
    ];

    const DISTRICS = [
        [
            'name' => 'Chachapoyas',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Asuncion',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Balsas',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cheto',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Chiliquin',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Chuquibamba',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Granada',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Huancas',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'La Jalca',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Leimebamba',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Levanto',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Magdalena',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Mariscal Castilla',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Molinopampa',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Montevideo',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Olleros',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Quinjalca',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Francisco de Daguas',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Isidro de Maino',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Soloco',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Sonche',
            'province' => 'Chachapoyas',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Bagua',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Aramango',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Copallin',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'El Parco',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Imaza',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'La Peca',
            'province' => 'Bagua',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Jumbilla',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Chisquilla',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Churuja',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Corosha',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cuispes',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Florida',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Jazan',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Recta',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Carlos',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Shipasbamba',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Valera',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Yambrasbamba',
            'province' => 'Bongara',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Nieva',
            'province' => 'Condorcanqui',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'El Cenepa',
            'province' => 'Condorcanqui',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Río Santiago',
            'province' => 'Condorcanqui',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Lamud',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Camporredondo',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cocabamba',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Colcamar',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Conila',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Inguilpata',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Longuita',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Lonya Chico',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Luya',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Luya Viejo',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'María',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Ocalli',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Ocumal',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Pisuquia',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Providencia',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Cristóbal',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Francisco de Yeso',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Jerónimo',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Juan de Lopecancha',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Santa Catalina',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Santo Tomas',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Tingo',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Trita',
            'province' => 'Luya',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'San Nicolás',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Chirimoto',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cochamal',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Huambo',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Limabamba',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Longar',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Mariscal Benavides',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Milpuc',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Omia',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Totora',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Vista Alegre',
            'province' => 'Rodriguez de Mendoza',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Bagua Grande',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cajaruro',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Cumba',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'El Milagro',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Jamalca',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Lonya Grande',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Yamon',
            'province' => 'Utcubamba',
            'department' => 'Amazonas'
        ],
        [
            'name' => 'Huaraz',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cochabamba',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Colcabamba',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huanchay',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Independencia',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Jangas',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'La Libertad',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Olleros',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pampas Grande',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pariacoto',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pira',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Tarica',
            'province' => 'Huaraz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Aija',
            'province' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Coris',
            'province' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huacllan',
            'province' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'La Merced',
            'province' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Succha',
            'province' => 'Aija',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llamellin',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Aczo',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chaccho',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chingas',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Mirgas',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Juan de Rontoy',
            'province' => 'Antonio Raymondi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chacas',
            'province' => 'Asuncion',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Acochaca',
            'province' => 'Asuncion',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chiquian',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Abelardo Pardo Lezameta',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Antonio Raymondi',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Aquia',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cajacay',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Canis',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Colquioc',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huallanca',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huasta',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huayllacayan',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'La Primavera',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Mangas',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pacllon',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Miguel de Corpanqui',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ticllos',
            'province' => 'Bolognesi',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Carhuaz',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Acopampa',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Amashca',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Anta',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ataquero',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Marcara',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pariahuanca',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Miguel de Aco',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Shilla',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Tinco',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yungar',
            'province' => 'Carhuaz',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Luis',
            'province' => 'Carlos Fermin Fitzcarrald',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Nicolás',
            'province' => 'Carlos Fermin Fitzcarrald',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yauya',
            'province' => 'Carlos Fermin Fitzcarrald',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Casma',
            'province' => 'Casma',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Buena Vista Alta',
            'province' => 'Casma',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Comandante Noel',
            'province' => 'Casma',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yautan',
            'province' => 'Casma',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Corongo',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Aco',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Bambas',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cusca',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'La Pampa',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yanac',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yupan',
            'province' => 'Corongo',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huari',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Anra',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cajay',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chavin de Huantar',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huacachi',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huacchis',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huachis',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huantar',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Masin',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Paucas',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ponto',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Rahuapampa',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Rapayan',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Marcos',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Pedro de Chana',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Uco',
            'province' => 'Huari',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huarmey',
            'province' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cochapeti',
            'province' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Culebras',
            'province' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huayan',
            'province' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Malvas',
            'province' => 'Huarmey',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Caraz',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huallanca',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huata',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huaylas',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Mato',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pamparomas',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pueblo Libre',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santa Cruz',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santo Toribio',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yuracmarca',
            'province' => 'Huaylas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Piscobamba',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Casca',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Eleazar Guzmán Barron',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Fidel Olivas Escudero',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llama',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llumpa',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Lucma',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Musga',
            'province' => 'Mariscal Luzuriaga',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ocros',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Acas',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cajamarquilla',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Carhuapampa',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cochas',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Congas',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llipa',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Cristóbal de Rajan',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Pedro',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santiago de Chilcas',
            'province' => 'Ocros',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cabana',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Bolognesi',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Conchucos',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huacaschuque',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huandoval',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Lacabamba',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llapo',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pallasca',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pampas',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Tauca',
            'province' => 'Pallasca',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pomabamba',
            'province' => 'Pomabamba',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huayllan',
            'province' => 'Pomabamba',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Parobamba',
            'province' => 'Pomabamba',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Quinuabamba',
            'province' => 'Pomabamba',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Recuay',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Catac',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cotaparaco',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huayllapampa',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Llacllin',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Marca',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pampas Chico',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Pararin',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Tapacocha',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ticapampa',
            'province' => 'Recuay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chimbote',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Caceres del Perú',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Coishco',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Macate',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Moro',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Nepeña',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Samanco',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Santa',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Nuevo Chimbote',
            'province' => 'Santa',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Sihuas',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Acobamba',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Alfonso Ugarte',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cashapampa',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Chingalpo',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Huayllabamba',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Quiches',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ragash',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'San Juan',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Sicsibamba',
            'province' => 'Sihuas',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yungay',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Cascapara',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Mancos',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Matacoto',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Quillo',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Ranrahirca',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Shupluy',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Yanama',
            'province' => 'Yungay',
            'department' => 'Ancash'
        ],
        [
            'name' => 'Abancay',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chacoche',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Circa',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Curahuasi',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huanipaca',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Lambrama',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pichirhua',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Pedro de Cachora',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Tamburco',
            'province' => 'Abancay',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Andahuaylas',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Andarapa',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chiara',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huancarama',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huancaray',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huayana',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Kishuara',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pacobamba',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pacucha',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pampachiri',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pomacocha',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Antonio de Cachi',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Jerónimo',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Miguel de Chaccrampa',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Santa María de Chicmo',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Talavera',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Tumay Huaraca',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Turpo',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Kaquiabamba',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'José María Arguedas',
            'province' => 'Andahuaylas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Antabamba',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'El Oro',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huaquirca',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Juan Espinoza Medrano',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Oropesa',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pachaconas',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Sabaino',
            'province' => 'Antabamba',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chalhuanca',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Capaya',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Caraybamba',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chapimarca',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Colcabamba',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Cotaruse',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Ihuayllo',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Justo Apu Sahuaraura',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Lucre',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pocohuanca',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Juan de Chacña',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Sañayca',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Soraya',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Tapairihua',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Tintay',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Toraya',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Yanaca',
            'province' => 'Aymaraes',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Tambobamba',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Cotabambas',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Coyllurqui',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Haquira',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Mara',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Challhuahuacho',
            'province' => 'Cotabambas',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chincheros',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Anco_Huallo',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Cocharcas',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huaccana',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Ocobamba',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Ongoy',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Uranmarca',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Ranracancha',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Rocchacc',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'El Porvenir',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Los Chankas',
            'province' => 'Chincheros',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Chuquibambilla',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Curpahuasi',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Gamarra',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Huayllati',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Mamara',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Micaela Bastidas',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Pataypampa',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Progreso',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'San Antonio',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Turpay',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Vilcabamba',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Virundo',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Curasco',
            'province' => 'Grau',
            'department' => 'Apurimac'
        ],
        [
            'name' => 'Arequipa',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Alto Selva Alegre',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cayma',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cerro Colorado',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Characato',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chiguata',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Jacobo Hunter',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'La Joya',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mariano Melgar',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Miraflores',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mollebaya',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Paucarpata',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Pocsi',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Polobaya',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Quequeña',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Sabandia',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Sachaca',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'San Juan de Siguas',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'San Juan de Tarucani',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Santa Isabel de Siguas',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Santa Rita de Siguas',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Socabaya',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tiabaya',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Uchumayo',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Vitor',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yanahuara',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yarabamba',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yura',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'José Luis Bustamante Y Rivero',
            'province' => 'Arequipa',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Camana',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'José María Quimper',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mariano Nicolás Valcárcel',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mariscal Caceres',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Nicolás de Pierola',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Ocoña',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Quilca',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Samuel Pastor',
            'province' => 'Camana',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Caraveli',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Acarí',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Atico',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Atiquipa',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Bella Unión',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cahuacho',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chala',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chaparra',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huanuhuanu',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Jaqui',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Lomas',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Quicacha',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yauca',
            'province' => 'Caraveli',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Aplao',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Andagua',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Ayo',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chachas',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chilcaymarca',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Choco',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huancarqui',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Machaguay',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Orcopampa',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Pampacolca',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tipan',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Uñon',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Uraca',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Viraco',
            'province' => 'Castilla',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chivay',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Achoma',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cabanaconde',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Callalli',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Caylloma',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Coporaque',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huambo',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huanca',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Ichupampa',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Lari',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Lluta',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Maca',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Madrigal',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'San Antonio de Chuca',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Sibayo',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tapay',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tisco',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tuti',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yanque',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Majes',
            'province' => 'Caylloma',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chuquibamba',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Andaray',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cayarani',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Chichas',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Iray',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Río Grande',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Salamanca',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Yanaquihua',
            'province' => 'Condesuyos',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mollendo',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cocachacra',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Dean Valdivia',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Islay',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Mejia',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Punta de Bombón',
            'province' => 'Islay',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Cotahuasi',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Alca',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Charcana',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Huaynacotas',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Pampamarca',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Puyca',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Quechualla',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Sayla',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tauria',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Tomepampa',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Toro',
            'province' => 'La Union',
            'department' => 'Arequipa'
        ],
        [
            'name' => 'Ayacucho',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Acocro',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Acos Vinchos',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Carmen Alto',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chiara',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Ocros',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pacaycasa',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Quinua',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San José de Ticllas',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Juan Bautista',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santiago de Pischa',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Socos',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Tambillo',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Vinchos',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Jesús Nazareno',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Andrés Avelino Caceres Dorregaray',
            'province' => 'Huamanga',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cangallo',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chuschi',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Los Morochucos',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'María Parado de Bellido',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Paras',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Totos',
            'province' => 'Cangallo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sancos',
            'province' => 'Huanca Sancos',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Carapo',
            'province' => 'Huanca Sancos',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sacsamarca',
            'province' => 'Huanca Sancos',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santiago de Lucanamarca',
            'province' => 'Huanca Sancos',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huanta',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Ayahuanco',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huamanguilla',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Iguain',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Luricocha',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santillana',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sivia',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Llochegua',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Canayre',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Uchuraccay',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pucacolpa',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chaca',
            'province' => 'Huanta',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Miguel',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Anco',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Ayna',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chilcas',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chungui',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Luis Carranza',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Tambo',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Samugari',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Anchihuay',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Oronccoy',
            'province' => 'La Mar',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Puquio',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Aucara',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cabana',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Carmen Salcedo',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chaviña',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chipao',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huac-Huas',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Laramate',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Leoncio Prado',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Llauta',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Lucanas',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Ocaña',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Otoca',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Saisa',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Cristóbal',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Juan',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Pedro',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Pedro de Palco',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sancos',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santa Ana de Huaycahuacho',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santa Lucia',
            'province' => 'Lucanas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Coracora',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chumpi',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Coronel Castañeda',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pacapausa',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pullo',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Puyusca',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Francisco de Ravacayco',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Upahuacho',
            'province' => 'Parinacochas',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pausa',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Colta',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Corculla',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Lampa',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Marcabamba',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Oyolo',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Pararca',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Javier de Alpabamba',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San José de Ushua',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sara Sara',
            'province' => 'Paucar del Sara Sara',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Querobamba',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Belén',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chalcos',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Chilcayoc',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huacaña',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Morcolla',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Paico',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Pedro de Larcay',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'San Salvador de Quije',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Santiago de Paucaray',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Soras',
            'province' => 'Sucre',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huancapi',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Alcamenca',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Apongo',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Asquipata',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Canaria',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cayara',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Colca',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huamanquiquia',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huancaraylla',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Hualla',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Sarhua',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Vilcanchos',
            'province' => 'Victor Fajardo',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Vilcas Huaman',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Accomarca',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Carhuanca',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Concepcion',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Huambalpa',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Independencia',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Saurama',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Vischongo',
            'province' => 'Vilcas Huamán',
            'department' => 'Ayacucho'
        ],
        [
            'name' => 'Cajamarca',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Asuncion',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chetilla',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cospan',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Encañada',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Jesús',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Llacanora',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Los Baños del Inca',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Magdalena',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Matara',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Namora',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Juan',
            'province' => 'Cajamarca',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cajabamba',
            'province' => 'Cajabamba',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cachachi',
            'province' => 'Cajabamba',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Condebamba',
            'province' => 'Cajabamba',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Sitacocha',
            'province' => 'Cajabamba',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Celendin',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chumuch',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cortegana',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Huasmin',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Jorge Chávez',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'José Gálvez',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Miguel Iglesias',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Oxamarca',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Sorochuco',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Sucre',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Utco',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'La Libertad de Pallan',
            'province' => 'Celendin',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chota',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Anguia',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chadin',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chiguirip',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chimban',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Choropampa',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cochabamba',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Conchan',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Huambos',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Lajas',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Llama',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Miracosta',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Paccha',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pion',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Querocoto',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Juan de Licupis',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tacabamba',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tocmoche',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chalamarca',
            'province' => 'Chota',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Contumaza',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chilete',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cupisnique',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Guzmango',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Benito',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santa Cruz de Toledo',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tantarica',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Yonan',
            'province' => 'Contumaza',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cutervo',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Callayuc',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Choros',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Cujillo',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'La Ramada',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pimpingos',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Querocotillo',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Andrés de Cutervo',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Juan de Cutervo',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Luis de Lucma',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santa Cruz',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santo Domingo de la Capilla',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santo Tomas',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Socota',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Toribio Casanova',
            'province' => 'Cutervo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Bambamarca',
            'province' => 'Hualgayoc',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chugur',
            'province' => 'Hualgayoc',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Hualgayoc',
            'province' => 'Hualgayoc',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Jaen',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Bellavista',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chontali',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Colasay',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Huabal',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Las Pirias',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pomahuaca',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pucara',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Sallique',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Felipe',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San José del Alto',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Jaen',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Ignacio',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chirinos',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Huarango',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'La Coipa',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Namballe',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San José de Lourdes',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tabaconas',
            'province' => 'San Ignacio',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pedro Gálvez',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chancay',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Eduardo Villanueva',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Gregorio Pita',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Ichocan',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'José Manuel Quiroz',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'José Sabogal',
            'province' => 'San Marcos',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Miguel',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Bolivar',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Calquis',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Catilluc',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'El Prado',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'La Florida',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Llapa',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Nanchoc',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Niepos',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Gregorio',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Silvestre de Cochan',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tongod',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Unión Agua Blanca',
            'province' => 'San Miguel',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Pablo',
            'province' => 'San Pablo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Bernardino',
            'province' => 'San Pablo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'San Luis',
            'province' => 'San Pablo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Tumbaden',
            'province' => 'San Pablo',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Santa Cruz',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Andabamba',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Catache',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Chancaybaños',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'La Esperanza',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Ninabamba',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Pulan',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Saucepampa',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Sexi',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Uticyacu',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Yauyucan',
            'province' => 'Santa Cruz',
            'department' => 'Cajamarca'
        ],
        [
            'name' => 'Callao',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Bellavista',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Carmen de la Legua Reynoso',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'La Perla',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'La Punta',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Ventanilla',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Mi Perú',
            'province' => 'Prov. Const. del Callao',
            'department' => 'Callao'
        ],
        [
            'name' => 'Cusco',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ccorca',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Poroy',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'San Jerónimo',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'San Sebastian',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Santiago',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Saylla',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Wanchaq',
            'province' => 'Cusco',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Acomayo',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Acopia',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Acos',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Mosoc Llacta',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pomacanchi',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Rondocan',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Sangarara',
            'province' => 'Acomayo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Anta',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ancahuasi',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Cachimayo',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Chinchaypujio',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huarocondo',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Limatambo',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Mollepata',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pucyura',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Zurite',
            'province' => 'Anta',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Calca',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Coya',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Lamay',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Lares',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pisac',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'San Salvador',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Taray',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Yanatile',
            'province' => 'Calca',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Yanaoca',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Checca',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Kunturkanki',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Langui',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Layo',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pampamarca',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Quehue',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Tupac Amaru',
            'province' => 'Canas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Sicuani',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Checacupe',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Combapata',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Marangani',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pitumarca',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'San Pablo',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'San Pedro',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Tinta',
            'province' => 'Canchis',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Santo Tomas',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Capacmarca',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Chamaca',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Colquemarca',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Livitaca',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Llusco',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Quiñota',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Velille',
            'province' => 'Chumbivilcas',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Espinar',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Condoroma',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Coporaque',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ocoruro',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pallpata',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pichigua',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Suyckutambo',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Alto Pichigua',
            'province' => 'Espinar',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Santa Ana',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Echarate',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huayopata',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Maranura',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ocobamba',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Quellouno',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Kimbiri',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Santa Teresa',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Vilcabamba',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pichari',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Inkawasi',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Villa Virgen',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Villa Kintiarina',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Megantoni',
            'province' => 'La Convencion',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Paruro',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Accha',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ccapi',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Colcha',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huanoquite',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Omachaç',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Paccaritambo',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Pillpinto',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Yaurisque',
            'province' => 'Paruro',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Paucartambo',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Caicay',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Challabamba',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Colquepata',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huancarani',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Kosñipata',
            'province' => 'Paucartambo',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Urcos',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Andahuaylillas',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Camanti',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ccarhuayo',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ccatca',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Cusipata',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huaro',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Lucre',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Marcapata',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ocongate',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Oropesa',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Quiquijana',
            'province' => 'Quispicanchi',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Urubamba',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Chinchero',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huayllabamba',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Machupicchu',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Maras',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Ollantaytambo',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Yucay',
            'province' => 'Urubamba',
            'department' => 'Cusco'
        ],
        [
            'name' => 'Huancavelica',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acobambilla',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acoria',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Conayca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Cuenca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huachocolpa',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huayllahuara',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Izcuchaca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Laria',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Manta',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Mariscal Caceres',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Moya',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Nuevo Occoro',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Palca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pilchaca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Vilca',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Yauli',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ascensión',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huando',
            'province' => 'Huancavelica',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acobamba',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Andabamba',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Anta',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Caja',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Marcas',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Paucara',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pomacocha',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Rosario',
            'province' => 'Acobamba',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Lircay',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Anchonga',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Callanmarca',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ccochaccasa',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Chincho',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Congalla',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huanca-Huanca',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huayllay Grande',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Julcamarca',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Antonio de Antaparco',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santo Tomas de Pata',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Secclla',
            'province' => 'Angaraes',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Castrovirreyna',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Arma',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Aurahua',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Capillas',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Chupamarca',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Cocas',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huachos',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huamatambo',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Mollepampa',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Juan',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santa Ana',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Tantara',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ticrapo',
            'province' => 'Castrovirreyna',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Churcampa',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Anco',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Chinchihuasi',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'El Carmen',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'La Merced',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Locroja',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Paucarbamba',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Miguel de Mayocc',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Pedro de Coris',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pachamarca',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Cosme',
            'province' => 'Churcampa',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huaytara',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ayavi',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Córdova',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huayacundo Arma',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Laramarca',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ocoyo',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pilpichaca',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Querco',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Quito-Arma',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Antonio de Cusicancha',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Francisco de Sangayaico',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Isidro',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santiago de Chocorvos',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santiago de Quirahuara',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santo Domingo de Capillas',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Tambo',
            'province' => 'Huaytara',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pampas',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acostambo',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Acraquia',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ahuaycha',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Colcabamba',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Daniel Hernández',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huachocolpa',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huaribamba',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Ñahuimpuquio',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pazos',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Quishuar',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Salcabamba',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Salcahuasi',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'San Marcos de Rocchac',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Surcubamba',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Tintay Puncu',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Quichuas',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Andaymarca',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Roble',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Pichos',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Santiago de Tucuma',
            'province' => 'Tayacaja',
            'department' => 'Huancavelica'
        ],
        [
            'name' => 'Huanuco',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Amarilis',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chinchao',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Churubamba',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Margos',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Quisqui (Kichki)',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Francisco de Cayran',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Pedro de Chaulan',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Santa María del Valle',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Yarumayo',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pillco Marca',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Yacus',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Pablo de Pillao',
            'province' => 'Huanuco',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Ambo',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Cayna',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Colpas',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Conchamarca',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Huacar',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Francisco',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Rafael',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Tomay Kichwa',
            'province' => 'Ambo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'La Unión',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chuquis',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Marías',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pachas',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Quivilla',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Ripan',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Shunqui',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Sillapata',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Yanas',
            'province' => 'Dos de Mayo',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Huacaybamba',
            'province' => 'Huacaybamba',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Canchabamba',
            'province' => 'Huacaybamba',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Cochabamba',
            'province' => 'Huacaybamba',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pinra',
            'province' => 'Huacaybamba',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Llata',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Arancay',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chavín de Pariarca',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Jacas Grande',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Jircan',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Miraflores',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Monzón',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Punchao',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Puños',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Singa',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Tantamayo',
            'province' => 'Huamalíes',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Rupa-Rupa',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Daniel Alomía Robles',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Hermílio Valdizan',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'José Crespo y Castillo',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Luyando',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Mariano Damaso Beraun',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pucayacu',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Castillo Grande',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pueblo Nuevo',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Santo Domingo de Anda',
            'province' => 'Leoncio Prado',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Huacrachuco',
            'province' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Cholon',
            'province' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Buenaventura',
            'province' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'La Morada',
            'province' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Santa Rosa de Alto Yanajanca',
            'province' => 'Marañon',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Panao',
            'province' => 'Pachitea',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chaglla',
            'province' => 'Pachitea',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Molino',
            'province' => 'Pachitea',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Umari',
            'province' => 'Pachitea',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Puerto Inca',
            'province' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Codo del Pozuzo',
            'province' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Honoria',
            'province' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Tournavista',
            'province' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Yuyapichis',
            'province' => 'Puerto Inca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Jesús',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Baños',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Jivia',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Queropalca',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Rondos',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Francisco de Asís',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'San Miguel de Cauri',
            'province' => 'Lauricocha',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chavinillo',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Cahuac',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Chacabamba',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Aparicio Pomares',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Jacas Chico',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Obas',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Pampamarca',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Choras',
            'province' => 'Yarowilca',
            'department' => 'Huanuco'
        ],
        [
            'name' => 'Ica',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'La Tinguiña',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Los Aquijes',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Ocucaje',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Pachacutec',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Parcona',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Pueblo Nuevo',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Salas',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'San José de Los Molinos',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'San Juan Bautista',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Santiago',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Subtanjalla',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Tate',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Yauca del Rosario',
            'province' => 'Ica',
            'department' => 'Ica'
        ],
        [
            'name' => 'Chincha Alta',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Alto Laran',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Chavin',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Chincha Baja',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'El Carmen',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Grocio Prado',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Pueblo Nuevo',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'San Juan de Yanac',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'San Pedro de Huacarpana',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Sunampe',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Tambo de Mora',
            'province' => 'Chincha',
            'department' => 'Ica'
        ],
        [
            'name' => 'Nasca',
            'province' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'Changuillo',
            'province' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'El Ingenio',
            'province' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'Marcona',
            'province' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'Vista Alegre',
            'province' => 'Nasca',
            'department' => 'Ica'
        ],
        [
            'name' => 'Palpa',
            'province' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Llipata',
            'province' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Río Grande',
            'province' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Santa Cruz',
            'province' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Tibillo',
            'province' => 'Palpa',
            'department' => 'Ica'
        ],
        [
            'name' => 'Pisco',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Huancano',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Humay',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Independencia',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Paracas',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'San Andrés',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'San Clemente',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Tupac Amaru Inca',
            'province' => 'Pisco',
            'department' => 'Ica'
        ],
        [
            'name' => 'Huancayo',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Carhuacallanga',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chacapampa',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chicche',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chilca',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chongos Alto',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chupuro',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Colca',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Cullhuas',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'El Tambo',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huacrapuquio',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Hualhuas',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huancan',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huasicancha',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huayucachi',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ingenio',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pariahuanca',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pilcomayo',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pucara',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Quichuay',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Quilcas',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Agustín',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Jerónimo de Tunan',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Saño',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Sapallanga',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Sicaya',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Santo Domingo de Acobamba',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Viques',
            'province' => 'Huancayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Concepcion',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Aco',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Andamarca',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chambara',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Cochas',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Comas',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Heroínas Toledo',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Manzanares',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Mariscal Castilla',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Matahuasi',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Mito',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Nueve de Julio',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Orcotuna',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'San José de Quero',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Santa Rosa de Ocopa',
            'province' => 'Concepcion',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chanchamayo',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Perene',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pichanaqui',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Luis de Shuaro',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Ramon',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Vitoc',
            'province' => 'Chanchamayo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Jauja',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Acolla',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Apata',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ataura',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Canchayllo',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Curicaca',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'El Mantaro',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huamali',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huaripampa',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huertas',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Janjaillo',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Julcan',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Leonor Ordóñez',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Llocllapampa',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Marco',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Masma',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Masma Chicche',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Molinos',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Monobamba',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Muqui',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Muquiyauyo',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Paca',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Paccha',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pancan',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Parco',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pomacancha',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ricran',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Lorenzo',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Pedro de Chunan',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Sausa',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Sincos',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Tunan Marca',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Yauli',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Yauyos',
            'province' => 'Jauja',
            'department' => 'Junin'
        ],
        [
            'name' => 'Junin',
            'province' => 'Junin',
            'department' => 'Junin'
        ],
        [
            'name' => 'Carhuamayo',
            'province' => 'Junin',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ondores',
            'province' => 'Junin',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ulcumayo',
            'province' => 'Junin',
            'department' => 'Junin'
        ],
        [
            'name' => 'Satipo',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Coviriali',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Llaylla',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Mazamari',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pampa Hermosa',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Pangoa',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Río Negro',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Río Tambo',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Vizcatan del Ene',
            'province' => 'Satipo',
            'department' => 'Junin'
        ],
        [
            'name' => 'Tarma',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Acobamba',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huaricolca',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huasahuasi',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'La Unión',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Palca',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Palcamayo',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Pedro de Cajas',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'Tapo',
            'province' => 'Tarma',
            'department' => 'Junin'
        ],
        [
            'name' => 'La Oroya',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chacapalpa',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huay-Huay',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Marcapomacocha',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Morococha',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Paccha',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Santa Bárbara de Carhuacayan',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Santa Rosa de Sacco',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Suitucancha',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Yauli',
            'province' => 'Yauli',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chupaca',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Ahuac',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Chongos Bajo',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huachac',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Huamancaca Chico',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Juan de Iscos',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'San Juan de Jarpa',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Tres de Diciembre',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Yanacancha',
            'province' => 'Chupaca',
            'department' => 'Junin'
        ],
        [
            'name' => 'Trujillo',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'El Porvenir',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Florencia de Mora',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huanchaco',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'La Esperanza',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Laredo',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Moche',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Poroto',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Salaverry',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Simbal',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Victor Larco Herrera',
            'province' => 'Trujillo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Ascope',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chicama',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chocope',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Magdalena de Cao',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Paijan',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Rázuri',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Santiago de Cao',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Casa Grande',
            'province' => 'Ascope',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Bolivar',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Bambamarca',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Condormarca',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Longotea',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Uchumarca',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Ucuncha',
            'province' => 'Bolivar',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chepen',
            'province' => 'Chepen',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pacanga',
            'province' => 'Chepen',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pueblo Nuevo',
            'province' => 'Chepen',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Julcan',
            'province' => 'Julcan',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Calamarca',
            'province' => 'Julcan',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Carabamba',
            'province' => 'Julcan',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huaso',
            'province' => 'Julcan',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Otuzco',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Agallpampa',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Charat',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huaranchal',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'La Cuesta',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Mache',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Paranday',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Salpo',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sinsicap',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Usquil',
            'province' => 'Otuzco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'San Pedro de Lloc',
            'province' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Guadalupe',
            'province' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Jequetepeque',
            'province' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pacasmayo',
            'province' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'San José',
            'province' => 'Pacasmayo',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Tayabamba',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Buldibuyo',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chillia',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huancaspata',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huaylillas',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huayo',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Ongon',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Parcoy',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pataz',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Pias',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Santiago de Challas',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Taurija',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Urpay',
            'province' => 'Pataz',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Huamachuco',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chugay',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Cochorco',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Curgos',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Marcabal',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sanagoran',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sarin',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sartimbamba',
            'province' => 'Sanchez Carrion',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Santiago de Chuco',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Angasmarca',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Cachicadan',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Mollebamba',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Mollepata',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Quiruvilca',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Santa Cruz de Chuca',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sitabamba',
            'province' => 'Santiago de Chuco',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Cascas',
            'province' => 'Gran Chimu',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Lucma',
            'province' => 'Gran Chimu',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Marmot',
            'province' => 'Gran Chimu',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Sayapullo',
            'province' => 'Gran Chimu',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Viru',
            'province' => 'Viru',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chao',
            'province' => 'Viru',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Guadalupito',
            'province' => 'Viru',
            'department' => 'La Libertad'
        ],
        [
            'name' => 'Chiclayo',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Chongoyape',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Eten',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Eten Puerto',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'José Leonardo Ortiz',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'La Victoria',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Lagunas',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Monsefu',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Nueva Arica',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Oyotun',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Picsi',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pimentel',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Reque',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Saña',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Cayalti',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Patapo',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pomalca',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pucala',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Tuman',
            'province' => 'Chiclayo',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Ferreñafe',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Cañaris',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Incahuasi',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Manuel Antonio Mesones Muro',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pitipo',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pueblo Nuevo',
            'province' => 'Ferreñafe',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Lambayeque',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Chochope',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Illimo',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Jayanca',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Mochumi',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Morrope',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Motupe',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Olmos',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Pacora',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Salas',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'San José',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Tucume',
            'province' => 'Lambayeque',
            'department' => 'Lambayeque'
        ],
        [
            'name' => 'Lima',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ancón',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ate',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Barranco',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Breña',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Carabayllo',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chaclacayo',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chorrillos',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cieneguilla',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Comas',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'El Agustino',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Independencia',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Jesús María',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'La Molina',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'La Victoria',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lince',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Los Olivos',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lurigancho',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lurin',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Magdalena del Mar',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pueblo Libre',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Miraflores',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pachacamac',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pucusana',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Puente Piedra',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Punta Hermosa',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Punta Negra',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Rímac',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Bartolo',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Borja',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Isidro',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Juan de Lurigancho',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Juan de Miraflores',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Luis',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Martin de Porres',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Miguel',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Anita',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa María del Mar',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santiago de Surco',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Surquillo',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Villa El Salvador',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Villa María del Triunfo',
            'province' => 'Lima',
            'department' => 'Lima'
        ],
        [
            'name' => 'Barranca',
            'province' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Paramonga',
            'province' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pativilca',
            'province' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Supe',
            'province' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Supe Puerto',
            'province' => 'Barranca',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cajatambo',
            'province' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Copa',
            'province' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Gorgor',
            'province' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huancapon',
            'province' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Manas',
            'province' => 'Cajatambo',
            'department' => 'Lima'
        ],
        [
            'name' => 'Canta',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Arahuay',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huamantanga',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huaros',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lachaqui',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Buenaventura',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Rosa de Quives',
            'province' => 'Canta',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Vicente de Cañete',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Asia',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Calango',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cerro Azul',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chilca',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Coayllo',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Imperial',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lunahuana',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Mala',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Nuevo Imperial',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pacaran',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Quilmana',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Antonio',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Luis',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Cruz de Flores',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Zúñiga',
            'province' => 'Cañete',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huaral',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Atavillos Alto',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Atavillos Bajo',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Aucallama',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chancay',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ihuari',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lampian',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pacaraos',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Miguel de Acos',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Cruz de Andamarca',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Sumbilca',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Veintisiete de Noviembre',
            'province' => 'Huaral',
            'department' => 'Lima'
        ],
        [
            'name' => 'Matucana',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Antioquia',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Callahuanca',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Carampoma',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chicla',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cuenca',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huachupampa',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huanza',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huarochiri',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lahuaytambo',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Langa',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Laraos',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Mariatana',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ricardo Palma',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Andrés de Tupicocha',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Antonio',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Bartolomé',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Damian',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Juan de Iris',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Juan de Tantaranche',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Lorenzo de Quinti',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Mateo',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Mateo de Otao',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Pedro de Casta',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Pedro de Huancayre',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Sangallaya',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Cruz de Cocachacra',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Eulalia',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santiago de Anchucaya',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santiago de Tuna',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santo Domingo de Los Olleros',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Surco',
            'province' => 'Huarochiri',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huacho',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ambar',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Caleta de Carquin',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Checras',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Hualmay',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huaura',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Leoncio Prado',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Paccho',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa Leonor',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Santa María',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Sayan',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Vegueta',
            'province' => 'Huaura',
            'department' => 'Lima'
        ],
        [
            'name' => 'Oyon',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Andajes',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Caujul',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cochamarca',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Navan',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Pachangara',
            'province' => 'Oyon',
            'department' => 'Lima'
        ],
        [
            'name' => 'Yauyos',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Alis',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Allauca',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Ayaviri',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Azángaro',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cacra',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Carania',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Catahuasi',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Chocos',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Cochas',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Colonia',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Hongos',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huampara',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huancaya',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huangascar',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huantan',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Huañec',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Laraos',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Lincha',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Madean',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Miraflores',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Omas',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Putinza',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Quinches',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Quinocay',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Joaquín',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'San Pedro de Pilas',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Tanta',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Tauripampa',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Tomas',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Tupe',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Viñac',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Vitis',
            'province' => 'Yauyos',
            'department' => 'Lima'
        ],
        [
            'name' => 'Iquitos',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Alto Nanay',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Fernando Lores',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Indiana',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Las Amazonas',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Mazan',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Napo',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Punchana',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Torres Causana',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Belén',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'San Juan Bautista',
            'province' => 'Maynas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Yurimaguas',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Balsapuerto',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Jeberos',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Lagunas',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Santa Cruz',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Teniente Cesar López Rojas',
            'province' => 'Alto Amazonas',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Nauta',
            'province' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Parinari',
            'province' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Tigre',
            'province' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Trompeteros',
            'province' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Urarinas',
            'province' => 'Loreto',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Ramon Castilla',
            'province' => 'Mariscal Ramon Castilla',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Pebas',
            'province' => 'Mariscal Ramon Castilla',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Yavari',
            'province' => 'Mariscal Ramon Castilla',
            'department' => 'Loreto'
        ],
        [
            'name' => 'San Pablo',
            'province' => 'Mariscal Ramon Castilla',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Requena',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Alto Tapiche',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Capelo',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Emilio San Martin',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Maquia',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Puinahua',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Saquena',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Soplin',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Tapiche',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Jenaro Herrera',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Yaquerana',
            'province' => 'Requena',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Contamana',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Inahuaya',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Padre Márquez',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Pampa Hermosa',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Sarayacu',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Vargas Guerra',
            'province' => 'Ucayali',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Barranca',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Cahuapanas',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Manseriche',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Morona',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Pastaza',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Andoas',
            'province' => 'Datem del Marañon',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Putumayo',
            'province' => 'Putumayo',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Rosa Panduro',
            'province' => 'Putumayo',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Teniente Manuel Clavero',
            'province' => 'Putumayo',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Yaguas',
            'province' => 'Putumayo',
            'department' => 'Loreto'
        ],
        [
            'name' => 'Tambopata',
            'province' => 'Tambopata',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Inambari',
            'province' => 'Tambopata',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Las Piedras',
            'province' => 'Tambopata',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Laberinto',
            'province' => 'Tambopata',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Manu',
            'province' => 'Manu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Fitzcarrald',
            'province' => 'Manu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Madre de Dios',
            'province' => 'Manu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Huepetuhe',
            'province' => 'Manu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Iñapari',
            'province' => 'Tahuamanu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Iberia',
            'province' => 'Tahuamanu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Tahuamanu',
            'province' => 'Tahuamanu',
            'department' => 'Madre de Dios'
        ],
        [
            'name' => 'Moquegua',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Carumas',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Cuchumbaya',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Samegua',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'San Cristóbal',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Torata',
            'province' => 'Mariscal Nieto',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Omate',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Chojata',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Coalaque',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Ichuña',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'La Capilla',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Lloque',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Matalaque',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Puquina',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Quinistaquillas',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Ubinas',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Yunga',
            'province' => 'General Sanchez Cerro',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Ilo',
            'province' => 'Ilo',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'El Algarrobal',
            'province' => 'Ilo',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Pacocha',
            'province' => 'Ilo',
            'department' => 'Moquegua'
        ],
        [
            'name' => 'Chaupimarca',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Huachon',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Huariaca',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Huayllay',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Ninacaca',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Pallanchacra',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Paucartambo',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'San Francisco de Asís de Yarusyacan',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Simon Bolivar',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Ticlacayan',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Tinyahuarco',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Vicco',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Yanacancha',
            'province' => 'Pasco',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Yanahuanca',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Chacayan',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Goyllarisquizga',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Paucar',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'San Pedro de Pillao',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Santa Ana de Tusi',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Tapuc',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Vilcabamba',
            'province' => 'Daniel Alcides Carrion',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Oxapampa',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Chontabamba',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Huancabamba',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Palcazu',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Pozuzo',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Puerto Bermúdez',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Villa Rica',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Constitución',
            'province' => 'Oxapampa',
            'department' => 'Pasco'
        ],
        [
            'name' => 'Piura',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Castilla',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Catacaos',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Cura Mori',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'El Tallan',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'La Arena',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'La Unión',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Las Lomas',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Tambo Grande',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Veintiseis de Octubre',
            'province' => 'Piura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Ayabaca',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Frias',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Jilili',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Lagunas',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Montero',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Pacaipampa',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Paimas',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sapillica',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sicchez',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Suyo',
            'province' => 'Ayabaca',
            'department' => 'Piura'
        ],
        [
            'name' => 'Huancabamba',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Canchaque',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'El Carmen de la Frontera',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Huarmaca',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Lalaquiz',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'San Miguel de El Faique',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sondor',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sondorillo',
            'province' => 'Huancabamba',
            'department' => 'Piura'
        ],
        [
            'name' => 'Chulucanas',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Buenos Aires',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Chalaco',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'La Matanza',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Morropon',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Salitral',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'San Juan de Bigote',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Santa Catalina de Mossa',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Santo Domingo',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Yamango',
            'province' => 'Morropon',
            'department' => 'Piura'
        ],
        [
            'name' => 'Paita',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Amotape',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Arenal',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Colan',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'La Huaca',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Tamarindo',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Vichayal',
            'province' => 'Paita',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sullana',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Bellavista',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Ignacio Escudero',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Lancones',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Marcavelica',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Miguel Checa',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Querecotillo',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Salitral',
            'province' => 'Sullana',
            'department' => 'Piura'
        ],
        [
            'name' => 'Pariñas',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'El Alto',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'La Brea',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'Lobitos',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'Los Organos',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'Mancora',
            'province' => 'Talara',
            'department' => 'Piura'
        ],
        [
            'name' => 'Sechura',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Bellavista de la Unión',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Bernal',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Cristo Nos Valga',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Vice',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Rinconada Llicuar',
            'province' => 'Sechura',
            'department' => 'Piura'
        ],
        [
            'name' => 'Puno',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Acora',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Amantani',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Atuncolla',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Capachica',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Chucuito',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Coata',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huata',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Mañazo',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Paucarcolla',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pichacani',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Plateria',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Antonio',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Tiquillaca',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Vilque',
            'province' => 'Puno',
            'department' => 'Puno'
        ],
        [
            'name' => 'Azángaro',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Achaya',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Arapa',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Asillo',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Caminaca',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Chupa',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'José Domingo Choquehuanca',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Muñani',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Potoni',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Saman',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Anton',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'San José',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Juan de Salinas',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Santiago de Pupuja',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Tirapata',
            'province' => 'Azángaro',
            'department' => 'Puno'
        ],
        [
            'name' => 'Macusani',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ajoyani',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ayapata',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Coasa',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Corani',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Crucero',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ituata',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ollachea',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Gaban',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Usicayos',
            'province' => 'Carabaya',
            'department' => 'Puno'
        ],
        [
            'name' => 'Juli',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Desaguadero',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huacullani',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Kelluyo',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pisacoma',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pomata',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Zepita',
            'province' => 'Chucuito',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ilave',
            'province' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Capazo',
            'province' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pilcuyo',
            'province' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Conduriri',
            'province' => 'El Collao',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huancane',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cojata',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huatasani',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Inchupalla',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pusi',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Rosaspata',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Taraco',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Vilque Chico',
            'province' => 'Huancane',
            'department' => 'Puno'
        ],
        [
            'name' => 'Lampa',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cabanilla',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Calapuja',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Nicasio',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ocuviri',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Palca',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Paratia',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pucara',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Santa Lucia',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Vilavila',
            'province' => 'Lampa',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ayaviri',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Antauta',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cupi',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Llalli',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Macari',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Nuñoa',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Orurillo',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Umachiri',
            'province' => 'Melgar',
            'department' => 'Puno'
        ],
        [
            'name' => 'Moho',
            'province' => 'Moho',
            'department' => 'Puno'
        ],
        [
            'name' => 'Conima',
            'province' => 'Moho',
            'department' => 'Puno'
        ],
        [
            'name' => 'Huayrapata',
            'province' => 'Moho',
            'department' => 'Puno'
        ],
        [
            'name' => 'Tilali',
            'province' => 'Moho',
            'department' => 'Puno'
        ],
        [
            'name' => 'Putina',
            'province' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ananea',
            'province' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'Pedro Vilca Apaza',
            'province' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'Quilcapuncu',
            'province' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'Sina',
            'province' => 'San Antonio de Putina',
            'department' => 'Puno'
        ],
        [
            'name' => 'Juliaca',
            'province' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cabana',
            'province' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cabanillas',
            'province' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'Caracoto',
            'province' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Miguel',
            'province' => 'San Roman',
            'department' => 'Puno'
        ],
        [
            'name' => 'Sandia',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cuyocuyo',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Limbani',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Patambuco',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Phara',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Quiaca',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Juan del Oro',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Yanahuaya',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Alto Inambari',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'San Pedro de Putina Punco',
            'province' => 'Sandia',
            'department' => 'Puno'
        ],
        [
            'name' => 'Yunguyo',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Anapia',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Copani',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Cuturapi',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Ollaraya',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Tinicachi',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Unicachi',
            'province' => 'Yunguyo',
            'department' => 'Puno'
        ],
        [
            'name' => 'Moyobamba',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Calzada',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Habana',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Jepelacio',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Soritor',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Yantalo',
            'province' => 'Moyobamba',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Bellavista',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Alto Biavo',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Bajo Biavo',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Huallaga',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Pablo',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Rafael',
            'province' => 'Bellavista',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San José de Sisa',
            'province' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Agua Blanca',
            'province' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Martin',
            'province' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Santa Rosa',
            'province' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Shatoja',
            'province' => 'El Dorado',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Saposoa',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Alto Saposoa',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'El Eslabón',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Piscoyacu',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Sacanche',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tingo de Saposoa',
            'province' => 'Huallaga',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Lamas',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Alonso de Alvarado',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Barranquita',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Caynarachi',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Cuñumbuqui',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pinto Recodo',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Rumisapa',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Roque de Cumbaza',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Shanao',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tabalosos',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Zapatero',
            'province' => 'Lamas',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Juanjuí',
            'province' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Campanilla',
            'province' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Huicungo',
            'province' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pachiza',
            'province' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pajarillo',
            'province' => 'Mariscal Caceres',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Picota',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Buenos Aires',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Caspisapa',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pilluana',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pucacaca',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Cristóbal',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Hilarión',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Shamboyacu',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tingo de Ponasa',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tres Unidos',
            'province' => 'Picota',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Rioja',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Awajun',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Elías Soplin Vargas',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Nueva Cajamarca',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Pardo Miguel',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Posic',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Fernando',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Yorongos',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Yuracyacu',
            'province' => 'Rioja',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tarapoto',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Alberto Leveau',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Cacatachi',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Chazuta',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Chipurana',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'El Porvenir',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Huimbayoc',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Juan Guerra',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'La Banda de Shilcayo',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Morales',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Papaplaya',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'San Antonio',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Sauce',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Shapaja',
            'province' => 'San Martin',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tocache',
            'province' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Nuevo Progreso',
            'province' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Polvora',
            'province' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Shunte',
            'province' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Uchiza',
            'province' => 'Tocache',
            'department' => 'San Martin'
        ],
        [
            'name' => 'Tacna',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Alto de la Alianza',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Calana',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Ciudad Nueva',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Inclan',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Pachia',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Palca',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Pocollay',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Sama',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Coronel Gregorio Albarracín Lanchipa',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'La Yarada los Palos',
            'province' => 'Tacna',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Candarave',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Cairani',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Camilaca',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Curibaya',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Huanuara',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Quilahuani',
            'province' => 'Candarave',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Locumba',
            'province' => 'Jorge Basadre',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Ilabaya',
            'province' => 'Jorge Basadre',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Ite',
            'province' => 'Jorge Basadre',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Tarata',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Héroes Albarracín',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Estique',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Estique-Pampa',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Sitajara',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Susapaya',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Tarucachi',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Ticaco',
            'province' => 'Tarata',
            'department' => 'Tacna'
        ],
        [
            'name' => 'Tumbes',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Corrales',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'La Cruz',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Pampas de Hospital',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'San Jacinto',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'San Juan de la Virgen',
            'province' => 'Contralmirante Villar',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Zorritos',
            'province' => 'Zarumilla',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Casitas',
            'province' => 'Zarumilla',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Canoas de Punta Sal',
            'province' => 'Zarumilla',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Zarumilla',
            'province' => 'Coronel Portillo',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Aguas Verdes',
            'province' => 'Coronel Portillo',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Matapalo',
            'province' => 'Coronel Portillo',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Papayal',
            'province' => 'Coronel Portillo',
            'department' => 'Tumbes'
        ],
        [
            'name' => 'Calleria',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Campoverde',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Iparia',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Masisea',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Yarinacocha',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Nueva Requena',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Manantay',
            'province' => 'Atalaya',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Raymondi',
            'province' => 'Padre Abad',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Sepahua',
            'province' => 'Padre Abad',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Tahuania',
            'province' => 'Padre Abad',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Yurua',
            'province' => 'Padre Abad',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Padre Abad',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Irazola',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Curimana',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Neshuya',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Alexander Von Humboldt',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ],
        [
            'name' => 'Purus',
            'province' => 'Purus',
            'department' => 'Ucayali'
        ]
    ];
}
