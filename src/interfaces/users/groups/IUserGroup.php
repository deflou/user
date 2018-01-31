<?php
namespace deflou\interfaces\users\groups;

use deflou\interfaces\ICanBeDescribed;
use deflou\interfaces\users\identities\IUserIdentity;

/**
 * Interface IUserGroup
 *
 * @package deflou\interfaces\users
 * @author deflou.dev@gmail.com
 */
interface IUserGroup extends IUserIdentity, ICanBeDescribed
{
    const FIELD__USERS = 'users';
    const FIELD__OPTIONS = 'options';
    const FIELD__CREATED = 'created';

    const USER_ROLE__OWNER = 'owner';
    const USER_ROLE__USER = 'user';

    /**
     * @param string $format
     * @return string|\DateTime
     */
    public function getCreated($format = '');

    /**
     * Reserved for future features
     *
     * @return array
     */
    public function getOptions(): array;

    /**
     * @return array
     */
    public function getUsers(): array;

    /**
     * @param array $users
     *
     * @return $this
     */
    public function setUsers($users);

    /**
     * @param string|IUserIdentity $user user name or user identity
     *
     * @return bool
     */
    public function hasUser($user): bool;

    /**
     * @param string|IUserIdentity $user user name or user identity
     *
     * @return bool
     */
    public function isOwner($user): bool;

    /**
     * @param IUserIdentity $user
     * @param string $userRole
     *
     * @return $this
     */
    public function addUser(IUserIdentity $user, $userRole = self::USER_ROLE__USER);

    /**
     * @param IUserIdentity $user
     *
     * @return $this
     */
    public function addOwner(IUserIdentity $user);
}
