<?php

declare(strict_types=1);

use Ziming\LaravelVidaId\Connectors\VidaIdentityVerificationConnector;
use Ziming\LaravelVidaId\Requests\IdentityVerification\CheckIdentityVerificationStatusRequest;
use Ziming\LaravelVidaId\Requests\IdentityVerification\GetIdentityVerificationDataRequest;
use Ziming\LaravelVidaId\Requests\IdentityVerification\PerformIdentityVerificationRequest;

/**
 * @throws Saloon\Exceptions\Request\FatalRequestException
 * @throws Saloon\Exceptions\Request\RequestException
 * @throws JsonException
 */
it('it can perform identity verification request', function (): void {

    $vidaIdentityVerificationConnector = new VidaIdentityVerificationConnector;

    // See the docs for the proper format
    $identityVerificationRequest = new PerformIdentityVerificationRequest(
        mobile: fake('id_ID')->phoneNumber, // will mobileNumber work?
        email: fake()->email,
        govId: fake('id_ID')->nik,
        fullName: fake()->name,
        dob: fake()->date,
        selfiePhoto: fake()->imageUrl,
        consentGiven: true,
        consentedAt: now()->toISOString(),
    );

    $response = $vidaIdentityVerificationConnector->send($identityVerificationRequest);

    expect($response->json())->toHaveKeys([
        'data',
        'data.eventId',
        'data.fields', // array of score & field
        'data.certificateIssued',
    ]); // 200

});

it('it can check check identity verification status request', function (): void {

    $vidaIdentityVerificationConnector = new VidaIdentityVerificationConnector;

    $eventId = Str::random();

    $checkIdentityVerificationStatusRequest = new CheckIdentityVerificationStatusRequest($eventId);

    $vidaIdentityVerificationConnector->send($checkIdentityVerificationStatusRequest);
});

it('it can get identity verification data request', function (): void {

    $vidaIdentityVerificationConnector = new VidaIdentityVerificationConnector;

    $eventId = Str::random();

    $getIdentityVerificationDataRequest = new GetIdentityVerificationDataRequest($eventId);

    $vidaIdentityVerificationConnector->send($getIdentityVerificationDataRequest);
});

$internalServerErrorsDataSet = [
    [
        '4611000101806300', // NIK
        'UserGDAA', // Userfull name
        '1980-01-01', // DOB YYYY-MM-DD
        '1000', // Error code
    ],
    [
        '4711000101806301',
        'UserGDAB',
        '1980-01-01',
        '1000',
    ],
    [
        '3528000101806302',
        'UserGDAC',
        '1980-01-01',
        '1000',
    ],
    [
        '3529000101806303',
        'UserGDAD',
        '1980-01-01',
        '1000',
    ],
    [
        '3552000101806304',
        'UserGDAE',
        '1980-01-01',
        '1000',
    ],
];

$incaseOfSlowResponseDataset = [
    [
        '3563000101806300',
        'UserGDAA',
        '1980-01-01',
        '1000',
    ],
    [
        '3564000101806301',
        'UserGDAB',
        '1980-01-01',
        '1000',
    ],
    [
        '3663000101806300',
        'UserGDAA',
        '1980-01-01',
        '1000',
    ],
    [
        '3664000101806301',
        'UserGDAB',
        '1980-01-01',
        '1000',
    ],
];

// Demographics Check

$demographicCheckSuccessDataset = [
    [
        '3511000101806300',
        'UserGDAA',
        '1980-01-01',
    ],
    [
        '3511000101806301',
        'UserGDAB',
        '1980-01-01',
    ],
];

$invalidFullNameDataset = [
    [
        '3511000101806300',
        'UserGDP',
        '1980-01-01',
    ],
    [
        '3511000101806301',
        'User',
        '1980-01-01',
    ],
];

$invalidDateOfBirthDataset = [
    [
        '3511000101806300',
        'UserGDAA',
        '1992-05-02',
    ],
    [
        '3511000101806301',
        'UserGDAB',
        '1992-05-21',
    ],
];

$extendedDemographicsParameters = [
    'motherMaidenName' => 'IBUGDAA',
    'pob' => 'KotaGDAA',
    'address' => 'AddrGDAA',
    'familyCardNo' => 'Same as NIK number (govid)',
    'village' => 'VilGDAA',
    'district' => 'DistGDAA',
    'city' => 'CityGDAA',
    'province' => 'ProvGDAA',
];

// Face Match Check

$faceMatchSuccessDataset = [
    [
        '3511000101806300',
        'UserGDAA',
        '1980-01-01',
    ],
    [
        '3511000101806301',
        'UserGDAB',
        '1980-01-01',
    ],
    [
        '3511000101806302',
        'UserGDAC',
        '1980-01-01',
    ],
];

$faceMatchFailureDataset = [
    [
        '3513000101806300',
        'UserGDAA',
        '1980-01-01',
    ],
    [
        '3513000101806301',
        'UserGDAB',
        '1980-01-01',
    ],
    [
        '3513000101806302',
        'UserGDAC',
        '1980-01-01',
    ],
];
