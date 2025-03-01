<?php

declare(strict_types=1);

return [
    'client_id' => env('VIDA_ID_CLIENT_ID'),
    'client_secret' => env('VIDA_ID_CLIENT_SECRET'),

    'authentication_api_url' => env('VIDA_ID_AUTHENTICATION_API_URL', 'https://qa-sso.vida.id/auth/realms/vida/protocol/openid-connect/token'),
    'identity_verification_api_base_url' => env('VIDA_ID_IDENTITY_VERIFICATION_API_BASE_URL', 'https://services-sandbox.vida.id/main/v3/services/'),
    'liveness_api_base_url' => env('VIDA_ID_LIVENESS_API_BASE_URL', 'https://services-sandbox.vida.id/biometrics/v2/services/face/liveliness'),
    'sign_inline_api_base_url' => env('VIDA_ID_SIGN_INLINE_API_BASE_URL', 'https://services-sandbox.vida.id/signer/v2/services/esign'),
    'e_Meterai_api_base_url' => env('VIDA_ID_E_METERAI_API_BASE_URL', 'https://sandbox-stamp-gateway.np.vida.id/'),
];
