<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin extends User 
{
    public function __construct() {
        // Directement définir les rôles pour l'instance Admin sans appeler parent::__construct()
        $this->roles = ['ROLE_ADMIN'];
    }
}
