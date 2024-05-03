<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController implements EventSubscriberInterface
{
    protected UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('agent')
                ->setFormTypeOption('choice_label', 'id')
                ->onlyOnForms(),
            AssociationField::new('agent')
                ->setFormTypeOption('disabled', 'true')
                ->onlyOnIndex()
                ->setFormTypeOption('property', 'id')
                ->setTemplatePath('@EasyAdmin/crud/field/association.html.twig'),
            ArrayField::new('roles'),
            TextField::new('username'),
            TextField::new('email'),
            TextField::new('password')
            ->setFormType(PasswordType::class),
            IntegerField::new('wallet'),
        ];
    }
    
    public static function getSubscribedEvents() {
        return [
            BeforeEntityPersistedEvent::class => ["hashPassword"]
        ];
    }

    public function hashPassword(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
    
        if ($entity instanceof User) {
            $plainPassword = $entity->getPassword();
            $hashedPassword = $this->passwordHasher->hashPassword($entity, $plainPassword);
            $entity->setPassword($hashedPassword);
        }
    

    }
    
}
