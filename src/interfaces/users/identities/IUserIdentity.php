<?php
namespace deflou\interfaces\users\identities;

/**
 * Interface IUserIdentity
 *
 * @package deflou\interfaces\users\identities
 * @author deflou.dev@gmail.com
 */
interface IUserIdentity
{
    const FIELD__NAME = 'name';
    const FIELD__NICKNAME = 'nickname';
    const FIELD__ROLE = 'role';
    const FIELD__GROUPS = 'groups';
    const FIELD__TOKEN = 'token';
    const FIELD__STATE = 'state';

    const STATE__SUBMITTED = 'submitted';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getNickname(): string;

    /**
     * @param string $nickname
     *
     * @return $this
     */
    public function setNickname($nickname);

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token);

    /**
     * @return string
     */
    public function getRole(): string;

    /**
     * @param string $role
     *
     * @return $this
     */
    public function setRole($role);

    /**
     * @return IUserIdentity[]
     */
    public function getGroups();

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @return bool
     */
    public function isSubmitted(): bool;

    /**
     * @return bool
     */
    public function save();
}
