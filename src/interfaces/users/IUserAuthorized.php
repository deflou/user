<?php
namespace deflou\interfaces\users;

use deflou\interfaces\users\identities\IUserIdentity;

/**
 * Interface IUserAuthorized
 *
 * @package deflou\interfaces\users
 * @author deflou.dev@gmail.com
 */
interface IUserAuthorized
{
    /**
     * @param array $config
     *
     * @return static
     */
    public static function getInstance($config = []);

    /**
     * UserBase constructor.
     * @param array|string $config
     *
     * @throws \Exception
     */
    public function __construct($config = []);

    /**
     * @return null|IUserIdentity
     */
    public function getIdentity();
}
