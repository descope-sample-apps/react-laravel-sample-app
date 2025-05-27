<?php

namespace App\Http\Controllers;

use Descope\SDK\DescopeSDK;
use Illuminate\Http\Request;
use App\Cache\LaravelCache;

class DescopeController extends Controller
{
    protected $descopeSDK;

    public function __construct(DescopeSDK $descopeSDK)
    {
        $this->descopeSDK = $descopeSDK;
    }

    public function verify(Request $request) {
        $authHeader = $request->header('Authorization');
        $sessionToken = null;
        if ($authHeader) {
            $sessionToken = str_replace('Bearer ', '', $authHeader);
            try {
                if($this->descopeSDK->verify($sessionToken)) {
                    return response()->json([
                        'status' => 'ok',
                        'message' => 'Session validated'
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid session token'
                    ], 401);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid session token'
                ], 401);
            }

        }

    }

    // Optional management function methods for user management
    // To use these methods, you need to set up a management key in the Descope Console and add the key to the .env file

    public function create(Request $request) {
        // Login ID and either email or phone number are required to create a user
        $loginId = "";
        $email = "";
        try {
            $reply = $this->descopeSDK->management->user->create($loginId = $loginId, $email = $email);
            if ($reply) {
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Created successfully',
                ]);
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to create user',
                ], 401);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user',
            ], 401);
        }

    }

    public function delete(Request $request) {
        // Login ID used to find the user and delete
        try {
            $loginId = "";
            $response = $this->descopeSDK->management->user->searchAll($loginId = $loginId);
            if ($response['total'] > 0) {
                $this->descopeSDK->management->user->delete($loginId = $loginId);
                return response()->json([
                    'status' => 'ok',
                    'message' => 'Deleted successfully',
                ]);
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to find user',
                ], 401);
            }
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find user',
            ], 401);
        }

    }



}
