<?php

namespace App\Exceptions;

use ErrorException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Validator;


trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isAcceptException($e)) {
            return $this->acceptExceptionResponse($e);
        }
        if ($this->isUsernameExistException($e)) {
            return $this->UsernameExistExceptionResponse($e);
        }
        if ($this->isQuery($e)) {
            return $this->AcceptExceptionResponse($e);
        }
        if ($this->isClientException($e)) {
            return $this->clientExceptionResponse($e);
        }
        if ($this->isServer($e)) {
            return $this->ServerResponse($e);
        }
        if ($this->isCode($e)) {
            return $this->CodeResponse($e);
        }
        if ($this->isSms($e)) {
            return $this->SmsResponse($e);
        }
        if ($this->isValidation($e)) {
            return $this->ValidationResponse($e);
        }

        if ($this->isModel($e)) {
            return $this->ModelResponse($e);
        }

        if ($this->isHttp($e)) {
            return $this->HttpResponse($e);
        }

        if ($this->isUnthorize($e)) {
            return $this->notUthorize($e);

        }
        return parent::render($request, $e);

    }

    protected function isAcceptException($e)
    {
        return $e instanceof AcceptException;
    }

    protected function isUsernameExistException($e)
    {
        return $e instanceof ExistUsernameException;
    }

    protected function isClientException($e)
    {
        return $e instanceof ClientException;
    }

    protected function isServer($e)
    {
        return $e instanceof ErrorException;
    }

    protected function isQuery($e)
    {
        return $e instanceof QueryException;
    }

    protected function isValidation($e)
    {
        return $e instanceof ValidationException;
    }


    protected function isSms($e)
    {
        return $e instanceof SmsException;
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }


    protected function isUnthorize($e)
    {


        return $e instanceof AuthorizationException;
    }


    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function isCode($e)
    {
        return $e instanceof CodeException;
    }

    protected function acceptExceptionResponse($e)
    {

        return response()->json(['meta' => [
            'message' => $e->getMessage(),
            'code' => Response::HTTP_NOT_ACCEPTABLE,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_NOT_ACCEPTABLE);
    }

    protected function UsernameExistExceptionResponse($e)
    {
        $errorMessage = $e->getMessage();
        return response()->json(['meta' => [
            'message' => $e->getMessage(),
            'code' => Response::HTTP_NOT_ACCEPTABLE,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_NOT_ACCEPTABLE);
    }


    protected function clientExceptionResponse($e)
    {
        return response()->json(['meta' => [
            'message' => $e->getMessage(),
            'code' => Response::HTTP_NOT_ACCEPTABLE,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_UNAUTHORIZED);
    }

    protected function ServerResponse($e)
    {
        $error_message = 'Internal Server Error';

        return response()->json(['meta' => [
            'message' => $error_message,
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function ValidationResponse($e)
    {
        $keys = array_keys($e->validator->errors()->getmessages());
        $error_message = $e->validator->errors()->getmessages()[$keys[0]][0];
        return response()->json([
            'meta' => [
            'message' => $error_message,
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function CodeResponse($e)
    {
        return response()->json(['meta' => [
            'message' => "Code Is Not Valid",
            'code' => Response::HTTP_BAD_REQUEST,
            'more_info' => config('more_info'),
            'errors' => null

        ]], Response::HTTP_BAD_REQUEST);
    }

    protected function SmsResponse($e)
    {
        return response()->json(['meta' => [
            'message' => "Sms Is Not Send",
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function ModelResponse($e)
    {
        return response()->json(['meta' => [
            'message' => $e->getMessage(),
            'code' => Response::HTTP_NOT_FOUND,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e)
    {
        return response()->json(['meta' => [
            'message' => "Method Not Allow",
            'code' => Response::HTTP_METHOD_NOT_ALLOWED,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_METHOD_NOT_ALLOWED);
    }

    protected function notUthorize($e)
    {
        return response()->json(['meta' => [
            'message' => "This request requires auth, The user must re-authorize.",
            'code' => Response::HTTP_UNAUTHORIZED,
            'more_info' => config('more_info'),
            'errors' => null
        ]], Response::HTTP_UNAUTHORIZED);
    }
}