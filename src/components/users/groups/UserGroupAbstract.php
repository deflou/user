<?php
namespace deflou\components\users;

use deflou\components\users\identities\UserIdentityAbstract;
use deflou\interfaces\users\identities\IUserIdentity;
use deflou\interfaces\users\groups\IUserGroup;

/**
 * Class UserGroup
 *
 * @package deflou\components\users
 * @author deflou.dev@gmail.com
 */
abstract class UserGroupAbstract extends UserIdentityAbstract implements IUserGroup
{
    /**
     * @var string
     */
    protected $identityClass = '';

    /**
     * @var IUserIdentity
     */
    protected $identity = null;

    /**
     * UserGroupAbstract constructor.
     * @param null $model
     *
     * @throws \Exception
     */
    public function __construct($model = null)
    {
        parent::__construct($model);

        if (empty($this->identityClass)) {
            throw new \Exception('Missed identity class. Please, define "identityClass" property.');
        }

        $identityClass = $this->identityClass;
        $this->identity = new $identityClass([IUserIdentity::FIELD__NAME => $this->getName()]);
    }

    /**
     * @param IUserIdentity $user
     * @param string $userRole
     *
     * @return $this
     */
    public function addUser(IUserIdentity $user, $userRole = self::USER_ROLE__USER)
    {
        $users = $this->getUsers();
        $users[$user->getName()] = $userRole;

        return $this->setUsers($users);
    }

    /**
     * @param IUserIdentity $user
     *
     * @return UserGroupAbstract
     */
    public function addOwner(IUserIdentity $user)
    {
        return $this->addUser($user, static::USER_ROLE__OWNER);
    }

    /**
     * @param IUserIdentity|string $user
     *
     * @return bool
     */
    public function hasUser($user): bool
    {
        $userName = is_string($user) ? $user : $user->getName();
        $users = $this->getUsers();

        return isset($users[$userName]);
    }

    /**
     * @param IUserIdentity|string $user
     *
     * @return bool
     */
    public function isOwner($user): bool
    {
        $userName = is_string($user) ? $user : $user->getName();
        $users = $this->getUsers();

        return isset($users[$userName]) && ($users[$userName] == static::USER_ROLE__OWNER) ? true : false;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return (array) $this->getGroupAttribute(static::FIELD__USERS);
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->getGroupAttribute(static::FIELD__OPTIONS);
    }

    /**
     * @param array $users
     *
     * @return UserGroupAbstract
     */
    public function setUsers($users)
    {
        return $this->setGroupAttribute(static::FIELD__USERS, $users);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getGroupAttribute(static::NAME);
    }

    /**
     * @param string $name
     *
     * @return UserGroupAbstract
     */
    public function setName($name)
    {
        return $this->setGroupAttribute(static::NAME, $name);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getGroupAttribute(static::TITLE);
    }

    /**
     * @param string $title
     *
     * @return UserGroupAbstract
     */
    public function setTitle($title)
    {
        return $this->setGroupAttribute(static::TITLE, $title);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getGroupAttribute(static::DESCRIPTION);
    }

    /**
     * @param string $description
     *
     * @return UserGroupAbstract
     */
    public function setDescription($description)
    {
        return $this->setGroupAttribute(static::DESCRIPTION, $description);
    }

    /**
     * @param string $format
     *
     * @return \DateTime|false|string
     */
    public function getCreated($format = '')
    {
        $timestamp = $this->getGroupAttribute(static::FIELD__CREATED);

        return $format ? date($format, $timestamp) : new \DateTime($timestamp);
    }

    /**
     * @return string
     */
    public function describe()
    {
        return $this->getTitle();
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getGroupAttribute($name)
    {
        return $this->model->$name;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    protected function setGroupAttribute($name, $value)
    {
        $this->model->$name = $value;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getAttribute($name)
    {
        $methodName = 'get' . ucfirst($name);

        if (method_exists($this->identity, $methodName)) {
            return $this->identity->$methodName();
        }

        throw new \Exception('Unknown identity property "' . $name . '"');
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     * @throws \Exception
     */
    protected function setAttribute($name, $value)
    {
        $methodName = 'set' . ucfirst($name);

        if (method_exists($this->identity, $methodName)) {
            return $this->identity->$methodName($value);
        }

        throw new \Exception('Unknown identity property "' . $name . '"');
    }
}
