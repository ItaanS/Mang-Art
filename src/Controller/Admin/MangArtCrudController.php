<?php

namespace App\Controller\Admin;

use App\Entity\MangArt;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class MangArtCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MangArt::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Mang\'Arts')
            ->setEntityLabelInSingular('Mang\'Art')
            
            ->setPageTitle("index", "Mang'Art - Administration des Mang'Arts")
            
            ->setPaginatorPageSize(10);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('name'),
            TextField::new('imageFile')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('calqMangart')
                ->setFormTypeOption('disabled', 'disabled'),
            TextEditorField::new('description'),
        ];
    }
    
}
