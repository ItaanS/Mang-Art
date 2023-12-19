<?php

namespace App\Controller\Admin;

use App\Entity\ThemArt;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ThemArtCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ThemArt::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Themes')
            ->setEntityLabelInSingular('Theme')
            
            ->setPageTitle("index", "Them'Art - Administration des Them'Art");


    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('name'),
            
        ];
    }
    
}
