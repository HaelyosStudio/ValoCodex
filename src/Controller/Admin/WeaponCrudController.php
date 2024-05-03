<?php

namespace App\Controller\Admin;

use App\Entity\Weapon;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class WeaponCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Weapon::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('weaponCategory')
                ->setFormTypeOption('choice_label', 'id')
                ->onlyOnForms(),
            AssociationField::new('weaponCategory')
                ->setFormTypeOption('disabled', 'true')
                ->onlyOnIndex()
                ->setFormTypeOption('property', 'id')
                ->setTemplatePath('@EasyAdmin/crud/field/association.html.twig'),
            TextField::new('name'),
            NumberField::new('primary_fire'),
            NumberField::new('secondary_fire'),
            IntegerField::new('mag_capacity'),
            TextField::new('wall_penetration'),
            IntegerField::new('price'),
            TextField::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('imageName')->setBasePath('/valo_images/weapons')->setUploadDir('/public')->onlyOnIndex()
        ];
    }
}
