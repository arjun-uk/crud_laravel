<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;

class ApiController extends Controller
{

    
    public function login_api(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);


            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            //$token = $user->createToken('my-app-token')->plainTextToken;
            $tokenResult = $user->createToken('authToken');

            $token = $tokenResult->accessToken;
            return response()->json([
                'message' => 'you have been logged in successfully',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'email' => $user->email,
                'name' => $user->name,
                'user_id' => $user->id,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while trying to login',
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function register_api(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while trying to register',
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function get_products(Request $request)
    {
        try {

            $products = products::orderBy('created_at', 'desc')->get();

            if (!$products->isEmpty()) {
                return response()->json([
                    'errorcode' => 0,
                    'message' => 'Products retrieved successfully',
                    'data' => $products
                ], 200);
            } else {
                return response()->json([
                    'errorcode' => 1,
                    'message' => 'No products found',
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while trying to get products',
                "error" => $e->getMessage()
            ], 500);
        }

    }

    public function add_product(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'product_price' => 'required',
                'product_quantity' => 'required',
                'product_category' => 'required',
                'product_image' => 'required',
            ]);



            $product = products::create([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_category' => $request->product_category,
                'product_image' => $request->product_image,
            ]);

            return response()->json([
                'message' => 'Product created successfully',
                'product' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while trying to add product',
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update_product(Request $request, $id)
    {

    }

    public function delete_product($id)
    {

    }

    public function search_product(Request $request)
    {

    }

    public function filter_product(Request $request)
    {

    }

    public function change_password(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);


            $user = auth('api')->user();



            if (!$user) {
                return response()->json([
                    'errorcode' => 1,
                    'message' => 'User not authenticated or invalid user instance.',
                    "error" => $user
                ], 401);
            }
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'errorcode' => 1,
                    'message' => 'Current password is incorrect.'
                ], 200);
            }
            $user->password = Hash::make($request->new_password);

            $user->save();

            return response()->json([
                'status' => 'success',
                'errorcode' => 0,
                'message' => 'Password updated successfully.',
                'user' => $user
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'errorcode' => 1,
                'message' => 'An error occurred while' . $e->getMessage()
            ]);
        }
    }

    public function get_profile(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required'
            ]);
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    'errorcode' => 1,
                    'message' => 'User not authenticated or invalid user instance.',
                    "error" => $user
                ], 401);
            }
            return response()->json([
                'errorcode' => 0,
                'message' => 'User retrieved successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'errorcode' => 1,
                'message' => 'An error occurred while trying to get user profile: ' . $e->getMessage()
            ]);
        }
    }

    public function update_profile(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $request->id
            ]);
            $user = User::find($request->id);
            if (!$user) {
                return response()->json([
                    'errorcode' => 1,
                    'message' => 'User not authenticated or invalid user instance.',
                    "error" => $user
                ], 401);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            return response()->json([
                'errorcode' => 0,
                'message' => 'User profile updated successfully',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while trying to update user profile',
                'status' => 'error',
            ]);
        }
    }

    public function send_firebase_notification(Request $request)
    {

        try {
            // Validate the request inputs
            $request->validate([
                'user_id' => 'required',
                'token' => 'required',
                'title' => 'required',
                'body' => 'required',
            ]);

            // Find the user by ID
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                    'status' => 'error',
                ]);
            }

            // Construct the notification payload
            $notification = [
                'title' => $request->title,
                'body' => $request->body,
            ];

            $data = [
                'user_id' => (string) $request->user_id,
                'token' => $request->token,
                'name' => $user->name,
            ];

            
            $firebaseCredentials = [
                "type" => env('FIREBASE_TYPE'),
                "project_id" => env('FIREBASE_PROJECT_ID'),
                "private_key_id" => env('FIREBASE_PRIVATE_KEY_ID'),
                "private_key" => str_replace("\\n", "\n", env('FIREBASE_PRIVATE_KEY')),
                "client_email" => env('FIREBASE_CLIENT_EMAIL'),
                "client_id" => env('FIREBASE_CLIENT_ID'),
                "auth_uri" => env('FIREBASE_AUTH_URI'),
                "token_uri" => env('FIREBASE_TOKEN_URI'),
                "auth_provider_x509_cert_url" => env('FIREBASE_AUTH_PROVIDER_X509_CERT_URL'),
                "client_x509_cert_url" => env('FIREBASE_CLIENT_X509_CERT_URL'),
                "universe_domain" => env('FIREBASE_UNIVERSE_DOMAIN')
            ];
            //$serviceAccount = json_decode(env('FCM_CREDENTIALS'), true);
           

            // Initialize Firebase
            $firebase = (new Factory)
            ->withServiceAccount($firebaseCredentials);

        $messaging = $firebase->createMessaging();

            $message = [
                'token' => $request->token,
                'notification' => $notification,
                'data' => $data,
            ];

            // Send the notification
            $messaging->send($message);

            return response()->json([
                'message' => 'Notification sent successfully',
                'status' => 'success',
                'notification' => $notification,
                'data' => $data,
            ]);

        } catch (MessagingException $e) {
            return response()->json([
                'message' => 'An error occurred while sending notification: ' . $e->getMessage(),
                'status' => 'error',
            ]);
        } catch (FirebaseException $e) {
            return response()->json([
                'message' => 'Firebase error: ' . $e->getMessage(),
                'status' => 'error',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
                'status' => 'error',
            ]);
        }
    }


}
