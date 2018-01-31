<?php
namespace deflou\interfaces\users\repositories;

use deflou\interfaces\users\identities\IUserIdentity;

/**
 * Interface IUserIdentitiesRepository
 *
 * @package deflou\interfaces\users\repositories
 * @author deflou.dev@gmail.com
 */
interface IUserIdentitiesRepository
{
    /**
     * @param $where
     *
     * @return IUserIdentity|null
     */
    public static function find($where): IUserIdentity;
}
