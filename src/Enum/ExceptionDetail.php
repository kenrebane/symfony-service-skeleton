<?php

namespace App\Enum;

class ExceptionDetail
{
  const CHECK_DOC = 'check documentation for contacts';
  const WRONG_REQUEST_DATA = 'Provided data is wrong. Check call parameters and(or) body. Check documentation.';
  const VALIDATION = 'Required parameters missing from request. Check documentation.';
}