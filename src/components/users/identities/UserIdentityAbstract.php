<?php
namespace deflou\components\users\identities;

use deflou\interfaces\users\identities\IUserIdentity;

/**
 * Class UserIdentityAbstract
 *
 * @package deflou\components\users\identities
 * @author deflou.dev@gmail.com
 */
abstract class UserIdentityAbstract implements IUserIdentity
{
    /**
     * @var mixed
     */
    protected $model = null;

    /**
     * UserIdentityAbstract constructor.
     * @param mixed $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(static::FIELD__NAME);
    }

    /**
     * @param string $name
     *
     * @return UserIdentityAbstract
     */
    public function setName($name)
    {
        return $this->setAttribute(static::FIELD__NAME, $name);
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->getAttribute(static::FIELD__NICKNAME);
    }

    /**
     * @param string $nickname
     *
     * @return UserIdentityAbstract
     */
    public function setNickname($nickname)
    {
        return $this->setAttribute(static::FIELD__NICKNAME, $nickname);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->getAttribute(static::FIELD__TOKEN);
    }

    /**
     * @param string $token
     *
     * @return UserIdentityAbstract
     */
    public function setToken($token)
    {
        return $this->setAttribute(static::FIELD__TOKEN, $token);
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->getAttribute(static::FIELD__ROLE);
    }

    /**
     * @param string $role
     *
     * @return UserIdentityAbstract
     */
    public function setRole($role)
    {
        return $this->setAttribute(static::FIELD__ROLE, $role);
    }

    /**
     * @return IUserIdentity[]
     */
    public function getGroups()
    {
        return $this->getAttribute(static::FIELD__GROUPS);
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->getAttribute(static::FIELD__STATE);
    }

    /**
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return $this->getState() == static::STATE__SUBMITTED;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    abstract protected function getAttribute($name);

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    abstract protected function setAttribute($name, $value);
}
