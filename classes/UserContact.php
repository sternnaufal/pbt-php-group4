<?php

class UserContact
{
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $address;

    public function __construct(string $firstName, string $lastName, string $phoneNumber, string $address)
    {
        $this->firstName = htmlspecialchars(trim($firstName));
        $this->lastName = htmlspecialchars(trim($lastName));
        $this->address = htmlspecialchars(trim($address));
        // 1. Validasi Firstname
        if (empty($this->firstName)) {
            throw new InvalidArgumentException("Error: First name can't be empty");
        }

        // 2. Validasi Lastname
        if (empty($this->lastName)) {
            throw new InvalidArgumentException("Error: Last name can't be empty");
        }

        // 3. Validasi Address
        if (empty($this->address)) {
            throw new InvalidArgumentException("Error: Address can't be empty");
        }


        if (preg_match('/[a-zA-Z]/', $phoneNumber)) {
            throw new InvalidArgumentException("Error: phone number can't contain letters");
        }
        $onlyNumbers = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (empty($onlyNumbers)) {
            throw new InvalidArgumentException("Error: phone number can't be empty");
        }

        $this->phoneNumber = htmlspecialchars($onlyNumbers);
    }

    public function getFullName(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getFormattedResult(): string
    {
        return "<div class='result-box'>
                    <p>Hi, my name is <strong>{$this->getFullName()}</strong></p>
                    <p>Phone Number : <strong>{$this->getPhoneNumber()}</strong></p>
                    <p>Address : <strong>" . nl2br($this->getAddress()) . "</strong></p>
                    <a href='index.php' class='reset-btn'>Reset</a>
                </div>";
    }
}
