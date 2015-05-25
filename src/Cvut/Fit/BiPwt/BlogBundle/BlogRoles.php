<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/24/15
 * Time: 11:04 PM
 */

namespace Cvut\Fit\BiPwt\BlogBundle;


abstract class BlogRoles{
    const ROLE_ANON = 'ROLE_ANON';  #nonautorised
    const ROLE_USER = 'ROLE_USER';  #autorised
    const ROLE_AUTHOR = 'ROLE_AUTHOR';  #author
    const ROLE_READER = 'ROLE_READER';  #reader
    const ROLE_ADMIN = 'ROLE_ADMIN';    #administrator
}