<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;



class UserAPIController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {

            return response()->json($this->userService->getAllUsers());

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function show($id)
    {
        try {

            return response()->json($this->userService->getUserById($id));

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }

    public function store(Request $request)
    {
    
        try {

            //$validated = $request->validated();
            $validated = $request->validate([
                'name' => 'string|max:255',
                'email' => 'required|email|unique:users,email,',
                'password' => 'string|min:4',
            ]);
            return response()->json($this->userService->createUser($validated), 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Bu eposta adresi kullanılmaktadır. Lütfen farklı bir mail adresi ile deneyin.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            if ($id != Auth::id()) {
                return response()->json(['message' => 'Sadece kendi hesabınızda değişiklik yapabilirsiniz.'], 405);
            }

            //$validated = $request->validated();
            $validated = $request->validate([
                'name' => 'string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'string|min:4',
            ]);

            return response()->json($this->userService->updateUser($id, $validated));

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Bu eposta adresi kullanılmaktadır. Lütfen farklı bir mail adresi ile deneyin.'], 500);
        }
    }

    public function delete($id)
    {
        try {

            if ($id != Auth::id()) {
                return response()->json(['message' => 'Sadece kendi hesabınızı silebilirsiniz.'], 405);
            }

            return response()->json(['message' => 'User Deleted', 'data' => $this->userService->deleteUser($id)], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong, please try again later.'], 500);
        }
    }
}
